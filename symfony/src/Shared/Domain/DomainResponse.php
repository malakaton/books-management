<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain;

interface DomainResponse
{
    public function toArray(): array;
}