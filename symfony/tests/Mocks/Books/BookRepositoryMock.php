<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Mocks\Books;

use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Tests\Mocks\Mock;

final class BookRepositoryMock extends Mock
{
    public function shouldFind(BookUuid $uuid, Book $bookExpected): self
    {
        $this->prophecy
            ->search($uuid)
            ->willReturn($bookExpected)
            ->shouldBeCalled();

        return $this;
    }
}