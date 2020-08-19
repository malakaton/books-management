<?php

declare(strict_types=1);

namespace BooksManagement\Author\Infrastructure\Persistence;

use BooksManagement\Author\Domain\Author;
use BooksManagement\Author\Domain\AuthorRepository;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class AuthorRepositoryMysql implements AuthorRepository
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Author::class);
    }

    public function search(AuthorUuid $authorUuid): ?Author
    {
        return $this->repository->find($authorUuid);
    }
}