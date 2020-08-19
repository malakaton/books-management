<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Request;

use BooksManagement\Shared\Domain\ContentType;

abstract class Request
{
    private RequestRepository $repository;
    private ContentType $type;
    private RequestContent $content;

    public function __construct(
        RequestRepository $repository,
        ContentType $type,
        RequestContent $content
    )
    {
        $this->repository = $repository;
        $this->type = $type;
        $this->content = $content;
    }

    public function type(): ContentType
    {
        return $this->type;
    }

    public function content(): RequestContent
    {
        return $this->content;
    }

    public function __toArray(): array
    {
        return $this->repository->__invoke($this->content());
    }
}