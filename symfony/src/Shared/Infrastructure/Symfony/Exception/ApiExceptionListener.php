<?php

declare(strict_types=1);

namespace BooksManagement\Shared\Infrastructure\Symfony\Exception;

use BooksManagement\Shared\Domain\ContentType;
use BooksManagement\Shared\Domain\Response\ResponseFactory;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ApiExceptionListener
{
    /**
     * @param ExceptionEvent $event
     * @throws ContentTypeNotFound
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        try {
            $message = json_decode($exception->getMessage(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $message = [
                'message' => $exception->getMessage(),
                'errors' => $exception->getTrace()
            ];
        }

        $response = ResponseFactory::basedOn(
            ContentType::_json,
            false,
            [],
            $message['message'],
            $exception->getCode() > 0 ? $exception->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR,
            $message['errors']
        );

        $event->setResponse(new Response($response->getContent(), Response::HTTP_OK, $response->getHeader()));
    }
}