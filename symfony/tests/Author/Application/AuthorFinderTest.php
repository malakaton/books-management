<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Author\Application;

use BooksManagement\Author\Domain\AuthorFinder;
use BooksManagement\Author\Domain\Exception\AuthorNotFound;
use BooksManagement\Tests\Author\Domain\AuthorMother;
use BooksManagement\Tests\Mocks\Author\AuthorRepositoryMockUnitTestCase;
use BooksManagement\Tests\Shared\Domain\Auhor\AuthorUuidMother;

final class AuthorFinderTest extends AuthorRepositoryMockUnitTestCase
{
    private AuthorFinder $authorFinderDomain;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authorFinderDomain = new AuthorFinder($this->MockRepository());
    }

    /**
     * @test
     * @throws AuthorNotFound
     */
    public function it_should_find_a_author(): void
    {
        $stubAuthor = AuthorMother::random(AuthorUuidMother::stub_uuid);

        $this->shouldSearch($stubAuthor->uuid(), $stubAuthor);

        self::assertEquals($stubAuthor, $this->authorFinderDomain->__invoke($stubAuthor->uuid()));
    }

    /**
     * @test
     * @throws AuthorNotFound
     */
    public function it_should_not_find_a_non_existing_author(): void
    {
        $this->shouldNotSearch();

        $this->expectException(AuthorNotFound::class);

        self::assertNull($this->authorFinderDomain->__invoke(AuthorUuidMother::random()));
    }
}