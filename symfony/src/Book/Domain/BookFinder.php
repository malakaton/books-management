<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain;

use BooksManagement\Book\Domain\Exception\BookNotFound;
use Psr\Log\LoggerInterface;

final class BookFinder
{
    private BookRepository $repository;
    private ElasticBookRepository $elasticRepository;
    private LoggerInterface $logger;

    public function __construct(
        BookRepository $repository,
        ElasticBookRepository $elasticRepository,
        LoggerInterface $logger
    ) {
        $this->repository = $repository;
        $this->elasticRepository = $elasticRepository;
        $this->logger = $logger;
    }

    /**
     * @param BookUuid $uuid
     * @return ?Book
     * @throws BookNotFound
     */
    public function __invoke(BookUuid $uuid): ?Book
    {
        $book = $this->elasticRepository->search($uuid);

        if (is_null($book)) {
            $book = $this->repository->search($uuid);

            if (!is_null($book)) {
                // Store book on elastic search engine
                $this->elasticRepository->save($book);
            }
        }

        $this->guard($uuid, $book);

        $this->logger->info("Book with uuid: {$uuid->value()} found");

        return $book;
    }

    /**
     * @param BookUuid $uuid
     * @param Book|null $book
     * @throws BookNotFound
     */
    private function guard(BookUuid $uuid, Book $book = null): void
    {
        if (null === $book) {
            $this->logger->alert("Book with uuid: {$uuid->value()} not found");
            throw new BookNotFound($uuid->value());
        }
    }
}