<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain;

use BooksManagement\Author\Domain\AuthorRepository;
use BooksManagement\Author\Domain\Exception\AuthorNotFound;
use BooksManagement\Shared\Domain\Author\AuthorUuid;

final class BookCreator
{
    private BookRepository $bookRepository;
    private AuthorRepository $authorRepository;

    public function __construct(BookRepository $bookRepository, AuthorRepository $authorRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
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

        $this->bookRepository->save($book);

        return $book->uuid();
    }

    /**
     * @param AuthorUuid $authorUuid
     * @throws AuthorNotFound
     */
    private function guardAuthorUuid(AuthorUuid $authorUuid): void
    {
        if (!$this->authorRepository->search($authorUuid)) {
            throw new AuthorNotFound($authorUuid->value());
        }
    }
}