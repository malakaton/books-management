<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Request;

use BooksManagement\Shared\Domain\ContentType;

final class Request
{
    private ContentType $type;
    private RequestContent $content;

    public function __construct(
        ContentType $type,
        RequestContent $content
    )
    {
        $this->type = $type;
        $this->content = $content;
    }

    public static function create(
        ContentType $type,
        RequestContent $content
    ): Request
    {
        return new self($type, $content);
    }

    public function type(): ContentType
    {
        return $this->type;
    }

    public function content(): RequestContent
    {
        return $this->content;
    }
}