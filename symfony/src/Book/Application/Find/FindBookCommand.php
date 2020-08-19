<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Find;

use BooksManagement\Shared\Domain\Command;

final class FindBookCommand implements Command
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id() : string
    {
        return $this->id;
    }
}