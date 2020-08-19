<?php

declare(strict_types=1);

namespace BooksManagement\Book\Domain\Exception;

use BooksManagement\Shared\Domain\DomainException;
use Throwable;

final class BookNotFound extends \Exception implements DomainException
{
    /**
     * BookNotFound constructor.
     * @param string $id
     * @param int $code
     * @param Throwable|null $previous
     * @throws \JsonException
     */
    public function __construct(string $id, int $code = 404, Throwable $previous = null) {
        parent::__construct(
            json_encode([
                'message' => 'The book has not been found',
                'errors' => [
                    'uuid' => [
                        "The book uuid {$id} doesn't exist"
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            $code,
            $previous
        );
    }
}