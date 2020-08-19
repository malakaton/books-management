<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Application\Find;

use BooksManagement\Book\Application\Find\BookFinder;
use BooksManagement\Book\Application\Find\FindBookHandler;
use BooksManagement\Book\Domain\BookRepository;
use BooksManagement\Tests\Book\Domain\BookMother;
use BooksManagement\Tests\Mocks\Books\BookRepositoryMock;
use BooksManagement\Tests\Mocks\Books\BooksModuleUnitTestCase;

final class FindBookCommandHandlerTest extends BooksModuleUnitTestCase
{
    private FindBookHandler $handler;
    private BookRepositoryMock $mockedRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockedRepository = new BookRepositoryMock($this->prophesize(BookRepository::class));
        $this->handler = new FindBookHandler(new BookFinder($this->mockedRepository->reveal()));
    }

    /** @test
     */
    public function it_should_find_a_book(): void
    {
        $command = FindBookCommandMother::random();

        $book = BookMother::random($command->id());

        $domainResponse = BookDomainResponseMother::create(
            $book->uuid(),
            $book->authorUuid(),
            $book->title(),
            $book->description(),
            $book->content()
        );

        $this->mockedRepository->shouldFind($book->uuid(), $book);

        self::assertEquals($domainResponse, $this->dispatch($command, $this->handler));
    }
}