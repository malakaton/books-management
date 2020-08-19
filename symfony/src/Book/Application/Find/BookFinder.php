<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Find;

use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Book\Domain\BookRepository;
use BooksManagement\Book\Domain\BookFinder as DomainBookFinder;
use BooksManagement\Book\Domain\Exception\BookNotFound;

final class BookFinder
{
    private DomainBookFinder $finder;

    public function __construct(BookRepository $repository)
    {
        $this->finder = new DomainBookFinder($repository);
    }

    /**
     * @param BookUuid $id
     * @return Book
     * @throws BookNotFound
     */
    public function __invoke(BookUuid $id)
    {
        return $this->finder->__invoke($id);
    }
}