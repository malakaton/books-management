<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Response;

use BooksManagement\Shared\Domain\ContentType;
use BooksManagement\Shared\Domain\ContentTypeNotFound;

final class ResponseFactory
{
    /**
     * @param string $type
     * @param bool $success
     * @param array $data
     * @param string $message
     * @param int $code
     * @param array $error
     * @return ResponseRepository
     * @throws ContentTypeNotFound
     */
    public static function basedOn(
        string $type,
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

        if ($responseType->isJSON()) {
            return new JsonResponse(
                $responseType,
                $responseSuccess,
                $responseData,
                $responseMessage,
                $responseCode,
                $responseError
            );
        }

        if ($responseType->isXML()) {
            return new XmlResponse(
                $responseType,
                $responseSuccess,
                $responseData,
                $responseMessage,
                $responseCode,
                $responseError
            );
        }

        throw new ContentTypeNotFound($type);
    }
}