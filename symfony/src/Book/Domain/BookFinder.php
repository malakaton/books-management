<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain;

use BooksManagement\Book\Domain\Exception\BookNotFound;

final class BookFinder
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
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
            throw new BookNotFound($uuid->value());
        }
    }
}