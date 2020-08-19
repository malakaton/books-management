<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Find;

use BooksManagement\Book\Domain\BookUuid;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use BooksManagement\Book\Domain\Exception\BookNotFound;

final class FindBookHandler implements MessageHandlerInterface
{
    private BookFinder $bookFinder;

    public function __construct(BookFinder $bookFinder)
    {
        $this->bookFinder = $bookFinder;
    }

    /**
     * @param FindBookCommand $command
     * @return BookDomainResponse
     * @throws BookNotFound
     */
    public function __invoke(FindBookCommand $command): BookDomainResponse
    {
        return (new BookResponseConverter())->__invoke(
            $this->bookFinder->find(new BookUuid($command->id()))
        );
    }
}