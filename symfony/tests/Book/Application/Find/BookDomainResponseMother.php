<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Application\Find;

use BooksManagement\Book\Application\Find\BookDomainResponse;
use BooksManagement\Book\Domain\BookContent;
use BooksManagement\Book\Domain\BookDescription;
use BooksManagement\Book\Domain\BookTitle;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Tests\Book\Domain\BookContentMother;
use BooksManagement\Tests\Book\Domain\BookDescriptionMother;
use BooksManagement\Tests\Book\Domain\BookTitleMother;
use BooksManagement\Tests\Book\Domain\BookUuidMother;
use BooksManagement\Tests\Shared\Domain\Auhor\AuthorUuidMother;

final class BookDomainResponseMother
{
    public static function create(
        BookUuid $uuid,
        AuthorUuid $authorUuid,
        BookTitle $title,
        BookDescription $description,
        BookContent $content
    ): BookDomainResponse
    {
        return new BookDomainResponse(
            $uuid->value(),
            $authorUuid->value(),
            $title->value(),
            $description->value(),
            $content->value()
        );
    }

    public static function random(): BookDomainResponse
    {
        return self::create(
            BookUuidMother::random(),
            AuthorUuidMother::random(),
            BookTitleMother::random(),
            BookDescriptionMother::random(),
            BookContentMother::random()
        );
    }
}