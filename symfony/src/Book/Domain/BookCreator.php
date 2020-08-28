<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain;

use BooksManagement\Author\Domain\AuthorRepository;
use BooksManagement\Author\Domain\Exception\AuthorNotFound;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use Psr\Log\LoggerInterface;

final class BookCreator
{
    private BookRepository $bookRepository;
    private AuthorRepository $authorRepository;
    private ElasticBookRepository $elasticRepository;
    private LoggerInterface $logger;

    public function __construct(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository,
        ElasticBookRepository $elasticRepository,
        LoggerInterface $logger
    ) {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
        $this->elasticRepository = $elasticRepository;
        $this->logger = $logger;
    }

    /**
     * @param AuthorUuid $authorUuid
     * @param BookTitle $title
     * @param BookDescription $description
     * @param BookContent $content
     * @return BookUuid
     * @throws AuthorNotFound
     */
    public function __invoke(
        AuthorUuid $authorUuid,
        BookTitle $title,
        BookDescription $description,
        BookContent $content
    ): BookUuid
    {
        $this->guardAuthorUuid($authorUuid);

        $book = Book::create($authorUuid, $title, $description, $content);

        $this->elasticRepository->save($book);

        $this->bookRepository->save($book);

        $this->logger->info("Book created with uuid: {$book->uuid()->value()}");

        return $book->uuid();
    }

    /**
     * @param AuthorUuid $authorUuid
     * @throws AuthorNotFound
     */
    private function guardAuthorUuid(AuthorUuid $authorUuid): void
    {
        if (!$this->authorRepository->search($authorUuid)) {
            $this->logger->alert("Author with uuid: {$authorUuid->value()} not found");
            throw new AuthorNotFound($authorUuid->value());
        }
    }
}