<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Response;

use BooksManagement\Shared\Domain\Response\Response;
use BooksManagement\Shared\Domain\Response\ResponseRepository;

final class ToXmlContentType implements ResponseRepository
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
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");

        $this->arrayToXml([
                'data' => $this->response->data()->value(),
                'meta' => [
                    'success' => $this->response->success()->value(),
                    'message' => $this->response->message()->value(),
                    'errors' => $this->response->errors()->value()
                ]
            ],
            $xml
        );

        return $xml->asXML();
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return ['Content-Type' => $this->response->type()->value()];
    }

    /**
     * @param $info
     * @param $xml
     */
    private function arrayToXml($info, $xml): void
    {
        foreach ($info as $key => $value) {
            if(is_array($value)) {
                $subNode = $xml->addChild((string) $key);
                $this->arrayToXml($value, $subNode);
            }
            else {
                $xml->addChild((string) $key, (string) $value);
            }
        }
    }
}