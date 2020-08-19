<?php

declare(strict_types=1);

namespace BooksManagement\Author\Domain;

use BooksManagement\Author\Domain\Exception\AuthorNotFound;
use BooksManagement\Shared\Domain\Author\AuthorUuid;

final class AuthorFinder
{
    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AuthorUuid $uuid
     * @return Author
     * @throws BookNotFound
     */
    public function __invoke(AuthorUuid $uuid): Author
    {
        $author = $this->repository->search($uuid);

        $this->guard($uuid, $author);

        return $author;
    }

    /**
     * @param AuthorUuid $uuid
     * @param Author|null $author
     * @throws AuthorNotFound
     */
    private function guard(AuthorUuid $uuid, Author $author = null): void
    {
        if (null === $author) {
            throw new AuthorNotFound($uuid->value());
        }
    }
}