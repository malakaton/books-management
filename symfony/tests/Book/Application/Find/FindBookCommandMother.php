<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Application\Find;

use BooksManagement\Book\Application\Find\FindBookCommand;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Tests\Book\Domain\BookUuidMother;

final class FindBookCommandMother
{
    public static function create(BookUuid $uuid): FindBookCommand
    {
        return new FindBookCommand($uuid->value());
    }

    public static function random(): FindBookCommand
    {
        return self::create(BookUuidMother::random());
    }
}