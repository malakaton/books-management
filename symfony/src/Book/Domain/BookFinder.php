<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain;

use BooksManagement\Book\Domain\Exception\BookNotFound;
use Psr\Log\LoggerInterface;

final class BookFinder
{
    private BookRepository $repository;
    private LoggerInterface $logger;

    public function __construct(BookRepository $repository, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @param BookUuid $uuid
     * @return ?Book
     * @throws BookNotFound
     */
    public function __invoke(BookUuid $uuid): ?Book
    {
        $book = $this->repository->search($uuid);

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