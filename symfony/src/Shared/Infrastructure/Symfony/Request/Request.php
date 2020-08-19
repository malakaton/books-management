<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Request;

use BooksManagement\Shared\Domain\Request\Request as DomainRequest;

abstract class Request
{
    private DomainRequest $request;

    public function __construct(DomainRequest $request)
    {
        $this->request = $request;
    }

    public function request(): DomainRequest
    {
        return $this->request;
    }
}