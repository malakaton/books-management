<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Find;

use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Book\Domain\BookRepository;
use BooksManagement\Book\Domain\BookFinder as DomainBookFinder;
use BooksManagement\Book\Domain\Exception\BookNotFound;
use Psr\Log\LoggerInterface;

final class BookFinder
{
    private DomainBookFinder $finder;

    public function __construct(BookRepository $repository, LoggerInterface $logger)
    {
        $this->finder = new DomainBookFinder($repository, $logger);
    }

    /**
     * @param BookUuid $uuid
     * @return ?Book
     * @throws BookNotFound
     */
    public function find(BookUuid $uuid): ?Book
    {
        return $this->finder->__invoke($uuid);
    }
}