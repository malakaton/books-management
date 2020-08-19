<?php

declare(strict_types=1);

namespace BooksManagement\Author\Domain;

use BooksManagement\Shared\Domain\Author\AuthorUuid;

final class Author
{
    private AuthorUuid $uuid;
    private AuthorName $name;
    private AuthorSurname $surname;

    public function __construct(
        AuthorUuid $uuid,
        AuthorName $name,
        AuthorSurname $surname
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function uuid(): AuthorUuid
    {
        return $this->uuid;
    }


    public function name(): AuthorName
    {
        return $this->name;
    }

    public function surname(): AuthorSurname
    {
        return $this->surname;
    }
}