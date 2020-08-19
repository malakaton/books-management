<?php

declare(strict_types=1);

namespace BooksManagement\Book\Infrastructure\Persistence;

use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Book\Domain\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class BookRepositoryMysql implements BookRepository
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Book::class);
    }

    /**
     * @param Book $book
     */
    public function save(Book $book): void
    {
        $this->entityManager->persist($book);

        $this->entityManager->flush();
    }

    /**
     * @param BookUuid $bookUuid
     * @return Book|null
     */
    public function search(BookUuid $bookUuid): ?Book
    {
        return $this->repository->find($bookUuid);
    }
}