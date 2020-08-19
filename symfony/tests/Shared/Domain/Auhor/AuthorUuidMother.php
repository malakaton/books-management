<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Shared\Domain\Auhor;

use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Tests\Shared\Domain\UuidMother;

final class AuthorUuidMother
{
    public static function create(string $value): AuthorUuid
    {
        return new AuthorUuid($value);
    }

    public static function random(): AuthorUuid
    {
        return self::create(UuidMother::random());
    }
}