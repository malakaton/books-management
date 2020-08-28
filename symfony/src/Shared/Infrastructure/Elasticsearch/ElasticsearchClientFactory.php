<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Elasticsearch;

use Elasticsearch\ClientBuilder;

final class ElasticsearchClientFactory
{
    public function __invoke(
        string $host,
        string $indexPrefix
    ): ElasticsearchClient {
        $client = ClientBuilder::create()->setHosts([$host])->build();

        return new ElasticsearchClient($client, $indexPrefix);
    }
}