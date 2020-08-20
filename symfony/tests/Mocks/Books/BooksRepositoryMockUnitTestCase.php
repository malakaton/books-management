<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Mocks\Books;

use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookContent;
use BooksManagement\Book\Domain\BookDescription;
use BooksManagement\Book\Domain\BookRepository;
use BooksManagement\Book\Domain\BookTitle;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Tests\Book\Domain\BookUuidMother;
use BooksManagement\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class BooksRepositoryMockUnitTestCase extends UnitTestCase
{
    /**
     * @var $repository BookRepository|MockInterface
     */
    private $repository;

    protected BookUuid $randomBookUuid;

    protected function setUp(): void
    {
        $this->randomBookUuid = $this->getRandomBookUuid();
    }

    protected function getRandomBookUuid(): BookUuid
    {
        return BookUuidMother::random();
    }

    protected function shouldSave(Book $book): void
    {
        $this->MockRepository()
            ->shouldReceive('save')
            ->with(\Mockery::on(function($argument) use ($book) {
                $this->assertInstanceOf(Book::class, $argument);
                $this->assertInstanceOf(BookUuid::class, $argument->uuid());
                $this->assertInstanceOf(AuthorUuid::class, $argument->authorUuid());
                $this->assertInstanceOf(BookTitle::class, $argument->title());
                $this->assertInstanceOf(BookDescription::class, $argument->description());
                $this->assertInstanceOf(BookContent::class, $argument->content());

                $this->assertEquals($argument->authorUuid(), $book->authorUuid());
                $this->assertEquals($argument->title(), $book->title());
                $this->assertEquals($argument->description(), $book->description());
                $this->assertEquals($argument->content(), $book->content());

                return true;
            }))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearch(BookUuid $uuid, ?Book $book): void
    {
        $this->MockRepository()
            ->shouldReceive('search')
            ->with(\Mockery::on(function($argument) use ($uuid) {
                $this->assertInstanceOf(BookUuid::class, $argument);
                $this->assertSame($this->randomBookUuid->value(), $argument->value());
                $this->assertEquals($argument->value(), $uuid->value());

                return true;
            }))
            ->once()
            ->andReturn($book);
    }

    /** @return BookRepository|MockInterface */
    protected function MockRepository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(BookRepository::class);
    }
}