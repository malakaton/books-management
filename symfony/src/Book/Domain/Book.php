<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain;

use BooksManagement\Shared\Domain\Author\AuthorUuid;

final class Book
{
    private BookUuid $uuid;
    private AuthorUuid $authorUuid;
    private BookTitle $title;
    private BookDescription $description;
    private BookContent $content;

    public function __construct(
        BookUuid $uuid,
        AuthorUuid $authorUuid,
        BookTitle $title,
        BookDescription $description,
        BookContent $content
    )
    {
        $this->uuid = $uuid;
        $this->authorUuid = $authorUuid;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
    }

    public static function create(
        AuthorUuid $authorUuid,
        BookTitle $title,
        BookDescription $description,
        BookContent $content
    ): Book
    {
        return new self(BookUuid::random(), $authorUuid, $title, $description, $content);
    }

    public function uuid(): BookUuid
    {
        return $this->uuid;
    }

    public function authorUuid(): AuthorUuid
    {
        return $this->authorUuid;
    }

    public function title(): BookTitle
    {
        return $this->title;
    }

    public function description(): BookDescription
    {
        return $this->description;
    }

    public function content(): BookContent
    {
        return $this->content;
    }
}