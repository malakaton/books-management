<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Create;

use BooksManagement\Author\Domain\Exception\AuthorNotFound;
use BooksManagement\Book\Domain\BookContent;
use BooksManagement\Book\Domain\BookDescription;
use BooksManagement\Book\Domain\BookTitle;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Shared\Domain\Author\AuthorUuid;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateBookHandler implements MessageHandlerInterface
{
    private BookCreator $bookCreator;

    public function __construct(BookCreator $bookCreator)
    {
        $this->bookCreator = $bookCreator;
    }

    /**
     * @param CreateBookCommand $command
     * @return BookUuid
     * @throws AuthorNotFound
     */
    public function __invoke(CreateBookCommand $command): BookUuid
    {
        $authorUuid = new AuthorUuid($command->authorUuid());
        $title = new BookTitle($command->title());
        $description = new BookDescription($command->description());
        $content = new BookContent($command->content());

        return $this->bookCreator->__invoke($authorUuid, $title, $description, $content);
    }
}