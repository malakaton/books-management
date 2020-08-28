<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Persistence\Elasticsearch;

use BooksManagement\Shared\Infrastructure\Elasticsearch\ElasticsearchClient;

abstract class ElasticsearchRepository
{
    private ElasticsearchClient $client;

    abstract protected function aggregateName(): string;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    protected function persist(string $id, array $plainBody): void
    {
        $this->client->persist($this->indexName(), $id, $plainBody);
    }

    protected function searchById(string $id): ?array
    {
        return $this->client->searchById($this->indexName(), $id);
    }

    protected function indexName(): string
    {
        return sprintf('%s-%s', $this->client->indexPrefix(), $this->aggregateName());
    }
}