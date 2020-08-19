<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Find;

use BooksManagement\Book\Domain\Book;

final class BookResponseConverter
{
    public function __invoke(Book $book): BookDomainResponse
    {
        return new BookDomainResponse(
            $book->uuid()->value(),
            $book->authorUuid()->value(),
            $book->title()->value(),
            $book->description()->value(),
            $book->content()->value()
        );
    }
}