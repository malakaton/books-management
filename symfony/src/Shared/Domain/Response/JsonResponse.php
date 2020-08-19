<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Response;

final class JsonResponse extends Response implements ResponseRepository
{
    /**
     * @return string
     * @throws \JsonException
     */
    public function getContent(): string
    {
        return json_encode(
            [
                'data' => $this->data()->value(),
                'meta' => [
                    'success' => $this->success()->value(),
                    'message' => $this->message()->value(),
                    'errors' => $this->errors()->value()
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
        return ['Content-Type' => $this->type()->value()];
    }
}