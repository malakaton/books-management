<?php

declare(strict_types=1);

namespace BooksManagement\Book\EntryPoint\Http\Controller;

use BooksManagement\Book\Application\Create\CreateBookCommand;
use BooksManagement\Book\Domain\BookUuid;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use BooksManagement\Shared\Infrastructure\Symfony\Request\RequestFactory;
use BooksManagement\Shared\Infrastructure\Symfony\Response\ResponseFactory;
use BooksManagement\Shared\Infrastructure\Symfony\Exception\SymfonyException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

final class CreateBookController
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
     * @throws SymfonyException
     */
    public function __invoke(Request $request): Response
    {
        $requestToArray = $this->parseToArray($request);

        $this->validateRequest($requestToArray);

        $uuid = $this->createBook($requestToArray);

        $response = ResponseFactory::basedOn(
            $request->getContentType(),
            true,
            [],
            "Book with uuid {$uuid->value()} created successfully",
            Response::HTTP_OK,
            []
        );

        return new Response($response->getContent(), Response::HTTP_CREATED, $response->getHeader());

    }

    /**
     * @param Request $request
     * @return array
     * @throws ContentTypeNotFound
     */
    private function parseToArray(Request $request): array
    {
        $domainRequest = RequestFactory::basedOn($request->getContentType(), $request->getContent());

        return $domainRequest->__toArray();
    }

    /**
     * @param array $input
     * @throws SymfonyException
     */
    private function validateRequest(array $input): void
    {
        $constraint = new Assert\Collection(
            [
                'book' => new Assert\Collection([
                    'author_uuid'   => new Assert\Uuid(),
                    'title'         => [
                        new Assert\NotBlank(),
                        new Assert\Length(['min' => 1, 'max' => 32]),
                        new Assert\Type('string')
                    ],
                    'description'   => [
                        new Assert\NotBlank(),
                        new Assert\Length(['min' => 4, 'max' => 255]),
                        new Assert\Type('string')
                    ],
                    'content'       => [
                        new Assert\NotBlank(),
                        new Assert\Length(['min' => 4, 'max' => 255]),
                        new Assert\Type('string')
                    ]
                ])
            ]
        );

        $validationErrors = Validation::createValidator()->validate($input, $constraint);

        if ($validationErrors->count() > 0) {
            $errors = [];
            foreach ($validationErrors as $error) {
                $errors[$error->getPropertyPath()][] = $error->getMessage();
            }
            throw new SymfonyException(
                'Validation error book constraint',
                $errors
            );
        }

    }

    private function createBook(array $input): BookUuid
    {
        /** @var HandledStamp $envelope */
        $envelope = $this->commandBus->dispatch(new CreateBookCommand(
            $input['book']['author_uuid'],
            $input['book']['title'],
            $input['book']['description'],
            $input['book']['content']
        ))->last(HandledStamp::class);

        return $envelope->getResult();
    }
}