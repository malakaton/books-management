<?php

declare(strict_types=1);

namespace BooksManagement\Tests\Mocks\Author;

use BooksManagement\Author\Domain\Author;
use BooksManagement\Author\Domain\AuthorRepository;
use BooksManagement\Author\Domain\Exception\AuthorNotFound;
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

    protected function shouldSearch(AuthorUuid $uuid, Author $author): void
    {
        $this->MockRepository()
            ->shouldReceive('search')
            ->with(\Mockery::on(function($argument) use ($uuid) {
                $this->assertInstanceOf(AuthorUuid::class, $argument);
                $this->assertEquals($argument->value(), $uuid->value());

                return true;
            }))
            ->once()
            ->andReturn($author);
    }

    protected function shouldNotSearch(): void
    {
        $this->MockRepository()
            ->shouldReceive('search')
            ->withAnyArgs()
            ->once()
            ->andReturnNull();
    }

    /** @return AuthorRepository|MockInterface */
    protected function MockRepository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(AuthorRepository::class);
    }
}