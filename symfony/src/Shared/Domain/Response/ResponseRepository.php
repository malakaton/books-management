<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Response;

interface ResponseRepository
{
    public function getContent(): string;
    public function getHeader(): array;
}