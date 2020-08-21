<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\EntryPoint\Http\Controller;

use BooksManagement\Tests\Book\Domain\BookContentMother;
use BooksManagement\Tests\Book\Domain\BookDescriptionMother;
use BooksManagement\Tests\Book\Domain\BookTitleMother;
use BooksManagement\Tests\Book\EntryPoint\EntryPointTestCase;
use BooksManagement\Tests\Shared\Domain\Auhor\AuthorUuidMother;
use Symfony\Component\HttpFoundation\Response;

final class CreateBookTest extends EntryPointTestCase
{
    /**
     * @test
     */
    public function save_book_works(): void
    {
        $this->client->request(
            'POST',
            '/book',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode([
                'book' => [
                    'author_uuid' => AuthorUuidMother::stub_uuid,
                    'title' => BookTitleMother::random()->value(),
                    'description' => BookDescriptionMother::random()->value(),
                    'content' => BookContentMother::random()->value()
                ]
            ])
        );

        self::assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());

        $this->assertJsonStructure(json_decode($this->client->getResponse()->getContent(), true));
    }

    /**
     * @test
     */
    public function save_book_fails_by_undefined_author_uuid(): void
    {
        $this->client->request(
            'POST',
            '/book',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode([
                'book' => [
                    'author_uuid' => null,
                    'title' => BookTitleMother::random()->value(),
                    'description' => BookDescriptionMother::random()->value(),
                    'content' => BookContentMother::random()->value()
                ]
            ])
        );

        $content = json_decode($this->client->getResponse()->getContent(), true);

        self::assertEquals("Validation error book constraint", $content['meta']['message']);
        self::assertArrayHasKey("[book][author_uuid]", $content['meta']['errors']);
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->client->getResponse()->getStatusCode());

        $this->assertJsonStructure(json_decode($this->client->getResponse()->getContent(), true));
    }

    /**
     * @test
     */
    public function save_book_fails_by_not_found_author_uuid(): void
    {
        $authorUuid = AuthorUuidMother::random();

        $this->client->request(
            'POST',
            '/book',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode([
                'book' => [
                    'author_uuid' => $authorUuid->value(),
                    'title' => BookTitleMother::random()->value(),
                    'description' => BookDescriptionMother::random()->value(),
                    'content' => BookContentMother::random()->value()
                ]
            ])
        );

        $content = json_decode($this->client->getResponse()->getContent(), true);

        self::assertEquals("The author has not been found", $content['meta']['message']);
        self::assertEquals("The author uuid {$authorUuid->value()} doesn't exist", $content['meta']['errors']['uuid'][0]);
        self::assertArrayHasKey("uuid", $content['meta']['errors']);
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());

        $this->assertJsonStructure(json_decode($this->client->getResponse()->getContent(), true));
    }
}