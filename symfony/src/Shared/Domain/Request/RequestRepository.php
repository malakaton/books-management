<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Request;

interface RequestRepository
{
    public function __invoke(RequestContent $content): array;
}