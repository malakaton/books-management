<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Author\Domain;

use BooksManagement\Author\Domain\Author;
use BooksManagement\Author\Domain\AuthorName;
use BooksManagement\Author\Domain\AuthorSurname;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Tests\Shared\Domain\Auhor\AuthorUuidMother;

final class AuthorMother
{
    public static function create(
        AuthorUuid $uuid,
        AuthorName $name,
        AuthorSurname $surname
    ): Author
    {
        return new Author($uuid, $name, $surname);
    }

    public static function random(string $uuid): Author
    {
        return self::create(
            AuthorUuidMother::create($uuid),
            AuthorNameMother::random(),
            AuthorSurnameMother::random()
        );
    }
}