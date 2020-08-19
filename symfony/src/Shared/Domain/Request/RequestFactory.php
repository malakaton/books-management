<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Request;

use BooksManagement\Shared\Domain\ContentType;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use BooksManagement\Shared\Infrastructure\Symfony\Request\FromJsonContentType;
use BooksManagement\Shared\Infrastructure\Symfony\Request\FromXmlContentType;

final class RequestFactory
{
    /**
     * @param string $type
     * @param string $request
     * @return array
     * @throws ContentTypeNotFound
     */
    public static function basedOn(
        string $type,
        string $request
    ): array
    {
        $requestContent = new RequestContent($request);
        $requestType = new ContentType($type);

        if ($requestType->isJSON()) {
            return (new JsonRequest(
                new FromJsonContentType(),
                $requestType,
                $requestContent
            ))->__toArray();
        }
        if ($requestType->isXML()) {
            return (new XmlRequest(
                new FromXmlContentType(),
                $requestType,
                $requestContent
            ))->__toArray();
        }

        throw new ContentTypeNotFound($type);
    }
}