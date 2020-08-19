<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Request;

use BooksManagement\Shared\Domain\ContentType;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use BooksManagement\Shared\Domain\Request\Request;
use BooksManagement\Shared\Domain\Request\RequestContent;
use BooksManagement\Shared\Domain\Request\RequestRepository;

final class RequestFactory
{
    /**
     * @param string $type
     * @param string $requestAttribute
     * @return RequestRepository
     * @throws ContentTypeNotFound
     */
    public static function basedOn(
        string $type,
        string $requestAttribute
    ): RequestRepository
    {
        $requestContent = new RequestContent($requestAttribute);
        $requestType = new ContentType($type);

        $request = Request::create($requestType, $requestContent);

        if ($requestType->isJSON()) {
            return new FromJsonContentType($request);
        }
        if ($requestType->isXML()) {
            return new FromXmlContentType($request);
        }

        throw new ContentTypeNotFound($type);
    }
}