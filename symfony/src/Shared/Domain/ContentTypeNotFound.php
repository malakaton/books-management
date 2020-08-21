<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain;

use Throwable;

final class ContentTypeNotFound extends \Exception implements DomainException
{
    /**
     * ContentTypeNotFound constructor.
     * @param ?string $type
     * @param int $code
     * @param Throwable|null $previous
     * @throws \JsonException
     */
    public function __construct(?string $type, int $code = 404, Throwable $previous = null) {
        parent::__construct(
            json_encode([
                'message' => 'Content-type unsupported',
                'errors' => [
                    'id' => [
                        "The content-type {$type} is not supported"
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            $code,
            $previous
        );
    }
}