<?php

declare(strict_types=1);

namespace BooksManagement\Book\Infrastructure\Persistence;

use BooksManagement\Book\Application\Find\BookResponseConverter;
use BooksManagement\Book\Domain\Book;
use BooksManagement\Book\Domain\BookContent;
use BooksManagement\Book\Domain\BookDescription;
use BooksManagement\Book\Domain\BookTitle;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Book\Domain\ElasticBookRepository;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use BooksManagement\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchRepository;

final class BookRepositoryElasticsearch extends ElasticsearchRepository implements ElasticBookRepository
{
    public function save(Book $book): void
    {
        $this->persist($book->uuid()->value(), (new BookResponseConverter())->__invoke($book)->toArray());
    }

    public function search(BookUuid $bookUuid): ?Book
    {
        if ($response = $this->searchById($bookUuid->value())) {
            return new Book(
                new BookUuid($response['_id']),
                new AuthorUuid($response['_source']['author_uuid']),
                new BookTitle($response['_source']['title']),
                new BookDescription($response['_source']['description']),
                new BookContent($response['_source']['content'])
            );
        }

        return null;
    }

    protected function aggregateName(): string
    {
        return 'books';
    }
}