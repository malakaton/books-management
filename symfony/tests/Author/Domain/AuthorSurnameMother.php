<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Author\Domain;

use BooksManagement\Author\Domain\AuthorSurname;
use BooksManagement\Tests\Shared\Domain\StringMother;

final class AuthorSurnameMother
{
    public static function create(string $value): AuthorSurname
    {
        return new AuthorSurname($value);
    }

    public static function random(): AuthorSurname
    {
        return self::create(StringMother::random());
    }
}