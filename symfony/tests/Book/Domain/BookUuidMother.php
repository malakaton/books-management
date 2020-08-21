<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Domain;

use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Tests\Shared\Domain\UuidMother;

final class BookUuidMother
{
    public const stub_uuid = 'b89021c3-8771-36a4-9d7d-5b39109b0ac5';

    public static function create(string $value): BookUuid
    {
        return new BookUuid($value);
    }

    public static function random(): BookUuid
    {
        return self::create(UuidMother::random());
    }
}