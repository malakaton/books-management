<?php

declare(strict_types=1);

namespace BooksManagement\Book\Infrastructure\Persistence\Doctrine;

use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class BookUuidType extends UuidType
{
    protected function typeClassName(): string
    {
        return BookUuid::class;
    }
}