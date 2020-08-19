<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Request;

use BooksManagement\Shared\Domain\Request\RequestRepository;
use BooksManagement\Shared\Infrastructure\Symfony\Exception\SymfonyException;

final class FromXmlContentType extends Request implements RequestRepository
{
    /**
     * @return array
     * @throws SymfonyException
     */
    public function __toArray(): array
    {
        try {
            $xml = simplexml_load_string(
                $this->request()->content()->value(),
                "SimpleXMLElement",
                LIBXML_NOCDATA
            );

            $json = json_encode($xml);
            return json_decode($json, true);
        } catch (\Exception $e) {
            throw new SymfonyException($e->getMessage(), $e->getTrace());
        }
    }
}