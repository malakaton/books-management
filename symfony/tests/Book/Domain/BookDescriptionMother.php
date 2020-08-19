<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Domain;

use BooksManagement\Book\Domain\BookDescription;
use BooksManagement\Tests\Shared\Domain\StringMother;

final class BookDescriptionMother
{
    public static function create(string $value): BookDescription
    {
        return new BookDescription($value);
    }

    public static function random(): BookDescription
    {
        return self::create(StringMother::random());
    }
}