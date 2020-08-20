<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Mocks\Author;

use BooksManagement\Author\Domain\Author;
use BooksManagement\Author\Domain\AuthorRepository;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Tests\Shared\Domain\Auhor\AuthorUuidMother;
use BooksManagement\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class AuthorRepositoryMockUnitTestCase extends UnitTestCase
{
    /**
     * @var $repository AuthorRepository|MockInterface
     */
    private $repository;
    protected AuthorUuid $randomAuthorUuid;

    protected function setUp(): void
    {
        $this->randomAuthorUuid = $this->getRandomAuthorUuid();
    }

    protected function getRandomAuthorUuid(): AuthorUuid
    {
        return AuthorUuidMother::random();
    }

    protected function shouldSearch(Author $author): void
    {
        $this->MockRepository()
            ->shouldReceive('search')
            ->with(\Mockery::on(function($uuid) {
                $this->assertInstanceOf(AuthorUuid::class, $uuid);
                $this->assertSame($this->randomAuthorUuid->value(), $uuid->value());

                return true;
            }))
            ->once()
            ->andReturn($author);
    }

    /** @return AuthorRepository|MockInterface */
    protected function MockRepository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(AuthorRepository::class);
    }
}