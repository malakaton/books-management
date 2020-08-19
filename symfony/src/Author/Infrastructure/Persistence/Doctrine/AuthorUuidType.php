<?php

declare(strict_types=1);

namespace BooksManagement\Author\Infrastructure\Persistence\Doctrine;

use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class AuthorUuidType extends UuidType
{
    protected function typeClassName(): string
    {
        return AuthorUuid::class;
    }
}