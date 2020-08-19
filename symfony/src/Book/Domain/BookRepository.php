<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain;

interface BookRepository
{
    public function save(Book $book): void;

    public function search(BookUuid $bookUuid): ?Book;

}