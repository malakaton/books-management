<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Mocks\Author;

use BooksManagement\Author\Domain\Author;
use BooksManagement\Shared\Domain\Author\AuthorUuid;

final class AuthorRepositoryMock extends AuthorRepositoryMockUnitTestCase
{
    public function getMockRepository()
    {
        $this->setUp();

        return $this->MockRepository();
    }

    public function shouldSearchAuthor(Author $author): void
    {
        $this->shouldSearch($author);
    }

    public function getAuthorUuid(): AuthorUuid
    {
        return $this->randomAuthorUuid;
    }
}