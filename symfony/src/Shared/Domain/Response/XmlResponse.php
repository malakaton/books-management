<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Response;

final class XmlResponse extends Response implements ResponseRepository
{
    /**
     * @return string
     */
    public function getContent(): string
    {

    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return ['Content-Type' => $this->type()->value()];
    }
}