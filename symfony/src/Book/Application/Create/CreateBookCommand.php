<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Create;

use BooksManagement\Shared\Domain\Command;

final class CreateBookCommand implements Command
{
    private string $authorUuid;
    private string $title;
    private string $description;
    private string $content;

    public function __construct(string $authorUuid, string $title, string $description, string $content)
    {
        $this->authorUuid   = $authorUuid;
        $this->title        = $title;
        $this->description  = $description;
        $this->content      = $content;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function authorUuid(): string
    {
        return $this->authorUuid;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function content(): string
    {
        return $this->content;
    }
}