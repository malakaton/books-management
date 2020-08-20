<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\Application\Find;

use BooksManagement\Book\Application\Find\BookFinder;
use BooksManagement\Book\Application\Find\FindBookHandler;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use BooksManagement\Shared\Infrastructure\Symfony\Response\ToJsonContentType;
use BooksManagement\Tests\Book\Domain\BookMother;
use BooksManagement\Tests\Mocks\Books\BooksRepositoryMockUnitTestCase;

final class FindBookCommandHandlerTest extends BooksRepositoryMockUnitTestCase
{
    private FindBookHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new FindBookHandler(new BookFinder($this->MockRepository()));
    }

    /**
     * @test
     * @throws ContentTypeNotFound
     */
    public function it_should_find_a_book(): void
    {
        $command = FindBookCommandMother::create($this->randomBookUuid);

        $book = BookMother::random($command->id());

        $domainResponse = BookDomainResponseMother::create(
            $book->uuid(),
            $book->authorUuid(),
            $book->title(),
            $book->description(),
            $book->content()
        );

        $this->shouldSearch($book->uuid(), $book);

        $domainResponseToJson = $domainResponse->getResponseByContentType('json');

        self::assertEquals($domainResponse, $this->dispatch($command, $this->handler));
        self::assertIsArray($domainResponse->toArray());
        self::assertEquals(
            $domainResponse->toArray(),
            [
                'uuid' => $domainResponse->uuid(),
                'author_uuid' => $domainResponse->authorUuid(),
                'title' => $domainResponse->title(),
                'description' => $domainResponse->description(),
                'content' => $domainResponse->content()
            ]
        );
        self::assertInstanceOf(ToJsonContentType::class, $domainResponseToJson);
    }
}