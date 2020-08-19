<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Request;

use BooksManagement\Shared\Domain\Request\RequestContent;
use BooksManagement\Shared\Domain\Request\RequestRepository;

final class FromJsonContentType implements RequestRepository
{
    public function __invoke(RequestContent $content): array
    {
        return json_decode($content->value(), true);
    }
}