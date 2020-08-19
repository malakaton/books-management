<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Domain;

use BooksManagement\Book\Domain\BookTitle;
use BooksManagement\Tests\Shared\Domain\StringMother;

final class BookTitleMother
{
    public static function create(string $value): BookTitle
    {
        return new BookTitle($value);
    }

    public static function random(): BookTitle
    {
        return self::create(StringMother::random());
    }
}