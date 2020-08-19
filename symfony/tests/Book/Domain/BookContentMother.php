<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Domain;

use BooksManagement\Book\Domain\BookContent;
use BooksManagement\Tests\Shared\Domain\StringMother;

final class BookContentMother
{
    public static function create(string $value): BookContent
    {
        return new BookContent($value);
    }

    public static function random(): BookContent
    {
        return self::create(StringMother::random());
    }
}