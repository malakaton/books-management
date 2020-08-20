<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Book\EntryPoint\Http\Controller;

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
        $this->client->request('GET', '/book/' . BookUuidMother::random());

        self::assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());

        $this->assertJsonStructure(json_decode($this->client->getResponse()->getContent(), true));
    }
}