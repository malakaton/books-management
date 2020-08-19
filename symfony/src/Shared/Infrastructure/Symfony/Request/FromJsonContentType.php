<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Request;

use BooksManagement\Shared\Domain\Request\RequestRepository;

final class FromJsonContentType extends Request implements RequestRepository
{
    public function __toArray(): array
    {
        return json_decode($this->request()->content()->value(), true);
    }
}