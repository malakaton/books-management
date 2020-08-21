<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\EntryPoint\Http\Controller;

use BooksManagement\Shared\Domain\ContentTypeNotFound;
use BooksManagement\Tests\Book\Domain\BookUuidMother;
use BooksManagement\Tests\Book\EntryPoint\EntryPointTestCase;
use Symfony\Component\HttpFoundation\Response;

final class GetBookByIdTest extends EntryPointTestCase
{
    /**
     * @test
     */
    public function get_book_by_id_not_found(): void
    {
        $uuid = BookUuidMother::random();

        $this->client->request(
            'GET',
            '/book/' . $uuid->value(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        self::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());

        $this->assertJsonStructure(json_decode($this->client->getResponse()->getContent(), true));
    }

    /**
     * @test
     */
    public function get_book_by_id_fails_by_undefined_content_type(): void
    {
        $this->client->request(
            'GET',
            '/book/' . BookUuidMother::stub_uuid,
            [],
            [],
            ['CONTENT_TYPE' => 'application/fake']
        );

        self::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());

        $this->assertJsonStructure(json_decode($this->client->getResponse()->getContent(), true));
    }

    /**
     * @test
     */
    public function get_book_by_id_works(): void
    {
        $this->client->request(
            'GET',
            '/book/' . BookUuidMother::stub_uuid,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        self::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $this->assertJsonStructure(json_decode($this->client->getResponse()->getContent(), true));
    }
}