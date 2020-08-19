<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Domain\Response;

use BooksManagement\Shared\Domain\ContentType;

abstract class Response
{
    private ContentType $type;
    private ResponseSuccess $success;
    private ResponseData $data;
    private ResponseMessage $message;
    private ResponseCode $code;
    private ResponseErrors $errors;

    public function __construct(
        ContentType $type,
        ResponseSuccess $success,
        ResponseData $data,
        ResponseMessage $message,
        ResponseCode $code,
        ResponseErrors $errors
    )
    {
        $this->type = $type;
        $this->success = $success;
        $this->data = $data;
        $this->code = $code;
        $this->message = $message;
        $this->errors = $errors;
    }

    public function type(): ContentType
    {
        return $this->type;
    }

    public function success(): ResponseSuccess
    {
        return $this->success;
    }

    public function data(): ResponseData
    {
        return $this->data;
    }

    public function code(): ResponseCode
    {
        return $this->code;
    }

    public function message(): ResponseMessage
    {
        return $this->message;
    }

    public function errors(): ResponseErrors
    {
        return $this->errors;
    }
}