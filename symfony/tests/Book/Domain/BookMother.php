<?php

declare(strict_types=1);


namespace BooksManagement\Tests\Book\Domain;


use BooksManagement\Book\Application\Create\CreateBookCommand;
use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookContent;
use BooksManagement\Book\Domain\BookDescription;
use BooksManagement\Book\Domain\BookTitle;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Tests\Shared\Domain\Auhor\AuthorUuidMother;

final class BookMother
{
    public static function create(
        BookUuid $uuid,
        AuthorUuid $authorUuid,
        BookTitle $title,
        BookDescription $description,
        BookContent $content
    ): Book
    {
        return new Book($uuid, $authorUuid, $title, $description, $content);
    }

    public static function fromRequest(CreateBookCommand $request): Book
    {
        return self::create(
            BookUuidMother::random(),
            AuthorUuidMother::create($request->authorUuid()),
            BookTitleMother::create($request->title()),
            BookDescriptionMother::create($request->description()),
            BookContentMother::create($request->content())
        );
    }

    public static function random(string $uuid): Book
    {
        return self::create(
            BookUuidMother::create($uuid),
            AuthorUuidMother::random(),
            BookTitleMother::random(),
            BookDescriptionMother::random(),
            BookContentMother::random()
        );
    }
}