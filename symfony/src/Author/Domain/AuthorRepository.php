<?php

declare(strict_types=1);

namespace BooksManagement\Author\Domain;

use BooksManagement\Shared\Domain\Author\AuthorUuid;

interface AuthorRepository
{
    public function search(AuthorUuid $authorUuid): ?Author;
}