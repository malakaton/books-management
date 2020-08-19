<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Response;

use BooksManagement\Shared\Domain\Response\Response;
use BooksManagement\Shared\Domain\Response\ResponseRepository;

final class ToJsonContentType implements ResponseRepository
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     * @throws \JsonException
     */
    public function getContent(): string
    {
        return json_encode(
            [
                'data' => $this->response->data()->value(),
                'meta' => [
                    'success' => $this->response->success()->value(),
                    'message' => $this->response->message()->value(),
                    'errors' => $this->response->errors()->value()
                ]
            ],
            JSON_THROW_ON_ERROR
        );
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return ['Content-Type' => $this->response->type()->value()];
    }
}