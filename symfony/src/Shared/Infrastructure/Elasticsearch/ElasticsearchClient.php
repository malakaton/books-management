<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Elasticsearch;

use Elasticsearch\Client;

final class ElasticsearchClient
{
    private Client $client;
    private string $indexPrefix;

    public function __construct(Client $client, string $indexPrefix)
    {
        $this->client      = $client;
        $this->indexPrefix = $indexPrefix;
    }

    public function persist(string $index, string $identifier, array $plainBody): void
    {
        $this->client->index(
            [
                'index' => $index,
                'id'    => $identifier,
                'body'  => $plainBody,
            ]
        );
    }

    public function searchById(string $index, string $identifier): ?array
    {
        if ($this->client->indices()->exists(['index' => $index])) {
            return $this->client->get(
                [
                    'index' => $index,
                    'id' => $identifier
                ]
            );
        }

        return null;
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function indexPrefix(): string
    {
        return $this->indexPrefix;
    }
}