<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain;

final class ContentType
{
    public const _json = 'json';
    public const _xml = 'xml';

    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function value(): string
    {
        return $this->type;
    }

    public function isJSON(): bool
    {
        return $this->type === self::_json;
    }

    public function isXML(): bool
    {
        return $this->type === self::_xml;
    }
}