<?php

declare(strict_types=1);

namespace BooksManagement\Book\Application\Find;

use BooksManagement\Shared\Domain\DomainResponse;
use BooksManagement\Shared\Domain\Response\ResponseFactory;
use BooksManagement\Shared\Domain\ContentTypeNotFound;
use BooksManagement\Shared\Domain\Response\ResponseRepository;
use Symfony\Component\HttpFoundation\Response;

final class BookDomainResponse implements DomainResponse
{
    private string $uuid;
    private string $authorUuid;
    private string $title;
    private string $description;
    private string $content;

    public function __construct(
        string $uuid,
        string $authorUuid,
        string $title,
        string $description,
        string $content
    ) {
        $this->uuid         = $uuid;
        $this->authorUuid   = $authorUuid;
        $this->title        = $title;
        $this->description  = $description;
        $this->content      = $content;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function authorUuid(): string
    {
        return $this->authorUuid;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function content(): string
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'uuid'          => $this->uuid,
            'author_uuid'   => $this->authorUuid,
            'title'         => $this->title,
            'description'   => $this->description,
            'content'       => $this->content
        ];
    }

    /**
     * @param string $contentType
     * @return ResponseRepository
     * @throws ContentTypeNotFound
     */
    public function getResponseByContentType(string $contentType): ResponseRepository
    {
        return ResponseFactory::basedOn(
            $contentType,
            true,
            $this->toArray(),
            '',
            Response::HTTP_OK,
            []
        );
    }
}