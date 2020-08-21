<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Response;

use BooksManagement\Shared\Domain\ContentType;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use BooksManagement\Shared\Domain\Response\Response;
use BooksManagement\Shared\Domain\Response\ResponseCode;
use BooksManagement\Shared\Domain\Response\ResponseData;
use BooksManagement\Shared\Domain\Response\ResponseErrors;
use BooksManagement\Shared\Domain\Response\ResponseMessage;
use BooksManagement\Shared\Domain\Response\ResponseRepository;
use BooksManagement\Shared\Domain\Response\ResponseSuccess;

final class ResponseFactory
{
    /**
     * @param ?string $type
     * @param bool $success
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $error
     * @return ResponseRepository
     * @throws ContentTypeNotFound
     */
    public static function basedOn(
        ?string $type,
        bool $success,
        array $data,
        string $message,
        int $code,
        array $error
    ): ResponseRepository
    {
        $responseType = new ContentType($type);
        $responseSuccess = new ResponseSuccess($success);
        $responseData = new ResponseData($data);
        $responseMessage = new ResponseMessage($message);
        $responseCode = new ResponseCode($code);
        $responseError = new ResponseErrors($error);

        $response = Response::create(
            $responseType,
            $responseSuccess,
            $responseData,
            $responseMessage,
            $responseCode,
            $responseError
        );

        if ($responseType->isJSON()) {
            return new ToJsonContentType($response);
        }

        if ($responseType->isXML()) {
            return new ToXmlContentType($response);
        }

        throw new ContentTypeNotFound($type);
    }
}