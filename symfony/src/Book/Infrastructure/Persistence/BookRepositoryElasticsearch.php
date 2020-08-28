<?php

declare(strict_types=1);

namespace BooksManagement\Book\Infrastructure\Persistence;

use BooksManagement\Book\Application\Find\BookResponseConverter;
use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Book\Domain\ElasticBookRepository;
use BooksManagement\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchRepository;

final class BookRepositoryElasticsearch extends ElasticsearchRepository implements ElasticBookRepository
{
    public function save(Book $book): void
    {
        $this->persist($book->uuid()->value(), (new BookResponseConverter())->__invoke($book)->toArray());
    }

    public function search(BookUuid $bookUuid): ?Book
    {
        
    }

    protected function aggregateName(): string
    {
        return 'books';
    }
}