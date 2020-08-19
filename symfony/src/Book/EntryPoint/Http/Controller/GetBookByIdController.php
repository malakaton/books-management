<?php

declare(strict_types=1);

namespace BooksManagement\Book\EntryPoint\Http\Controller;

use BooksManagement\Book\Application\Find\BookDomainResponse;
use BooksManagement\Book\Application\Find\FindBookCommand;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class GetBookByIdController
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws ContentTypeNotFound
     */
    public function __invoke(Request $request): Response
    {
        /** @var HandledStamp $envelope */
        $envelope = $this->commandBus->dispatch(new FindBookCommand(
            $request->get('id')
        ))->last(HandledStamp::class);

        /** @var BookDomainResponse $bookResponse */
        $bookResponse = $envelope->getResult();

        $response = $bookResponse->getResponseByContentType($request->getContentType());

        return new Response($response->getContent(), Response::HTTP_OK, $response->getHeader());
    }
}