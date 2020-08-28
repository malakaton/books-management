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

    public function persist(string $aggregateName, string $identifier, array $plainBody): void
    {
        $this->client->index(
            [
                'index' => sprintf('%s_%s', $this->indexPrefix, $aggregateName),
                'id'    => $identifier,
                'body'  => $plainBody,
            ]
        );
    }

    public function searchById(string $aggregateName, string $identifier): array
    {
        return $this->client->get(
            [
                'index' => sprintf('%s_%s', $this->indexPrefix, $aggregateName),
                'id'    => $identifier
            ]
        );
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