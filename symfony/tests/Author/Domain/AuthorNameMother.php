<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Author\Domain;

use BooksManagement\Author\Domain\AuthorName;
use BooksManagement\Tests\Shared\Domain\StringMother;

final class AuthorNameMother
{
    public static function create(string $value): AuthorName
    {
        return new AuthorName($value);
    }

    public static function random(): AuthorName
    {
        return self::create(StringMother::random());
    }
}