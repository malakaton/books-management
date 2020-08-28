<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Create;

use BooksManagement\Author\Domain\Exception\AuthorNotFound;
use BooksManagement\Book\Domain\BookContent;
use BooksManagement\Book\Domain\BookDescription;
use BooksManagement\Book\Domain\BookTitle;
use BooksManagement\Book\Domain\BookRepository;
use BooksManagement\Author\Domain\AuthorRepository;
use BooksManagement\Book\Domain\BookCreator as DomainBookCreator;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Book\Domain\ElasticBookRepository;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use Psr\Log\LoggerInterface;

final class BookCreator
{
    private DomainBookCreator $creator;

    public function __construct(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository,
        ElasticBookRepository $elasticRepository,
        LoggerInterface $logger
    ) {
        $this->creator = new DomainBookCreator($bookRepository, $authorRepository, $elasticRepository, $logger);
    }

    /**
     * @param AuthorUuid $authorUuid
     * @param BookTitle $title
     * @param BookDescription $description
     * @param BookContent $content
     * @return BookUuid
     * @throws AuthorNotFound
     */
    public function __invoke(
        AuthorUuid $authorUuid,
        BookTitle $title,
        BookDescription $description,
        BookContent $content
    ): BookUuid
    {
        return $this->creator->__invoke($authorUuid, $title, $description, $content);
    }
}