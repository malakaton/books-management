<?php

declare(strict_types=1);

namespace BooksManagement\Author\Domain\Exception;

use BooksManagement\Shared\Domain\DomainException;
use Throwable;

final class AuthorNotFound extends \Exception implements DomainException
{
    /**
     * AuthorNotFound constructor.
     * @param string $id
     * @param int $code
     * @param Throwable|null $previous
     * @throws \JsonException
     */
    public function __construct(string $id, int $code = 404, Throwable $previous = null) {
        parent::__construct(
            json_encode([
                'message' => 'The author has not been found',
                'errors' => [
                    'uuid' => [
                        "The author uuid {$id} doesn't exist"
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            $code,
            $previous
        );
    }
}