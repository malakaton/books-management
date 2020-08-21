<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Author\Infrastructure;

use BooksManagement\Author\Domain\Exception\AuthorNotFound;
use BooksManagement\Author\Infrastructure\Persistence\AuthorRepositoryMysql;
use BooksManagement\Tests\Shared\Domain\Auhor\AuthorUuidMother;
use BooksManagement\Tests\Shared\Infrastructure\Doctrine\DoctrineInfrastructureTestCase;

final class AuthorRepositoryTest extends DoctrineInfrastructureTestCase
{
    private AuthorRepositoryMysql $authorRepository;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->authorRepository = $this->repository(AuthorRepositoryMysql::class);
    }

    /** @test */
    public function it_should_not_return_a_non_existing_author(): void
    {
        self::assertNull($this->authorRepository->search(AuthorUuidMother::random()));
    }
}