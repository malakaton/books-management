<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Mocks\Books;

use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookRepository;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;
use Prophecy\Argument;

abstract class BooksModuleUnitTestCase extends UnitTestCase
{
    /**
     * @var $repository BookRepository|MockInterface
     */
    private $repository;

    protected function shouldSave(Book $book): void
    {
        $this->MockRepository()
            ->shouldReceive('save')
            ->with($book)
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearch(BookUuid $uuid, ?Book $book): void
    {
        $this->MockRepository()
            ->shouldReceive('search')
            ->with($uuid)
            ->once()
            ->andReturn($book);
    }

    /** @return BookRepository|MockInterface */
    protected function MockRepository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(BookRepository::class);
    }
}