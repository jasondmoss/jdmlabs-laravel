<?php

declare(strict_types=1);

namespace Aenginus\Article\Infrastructure\Entities;

use Aenginus\Article\Infrastructure\ValueObjects\Body;
use Aenginus\Article\Infrastructure\ValueObjects\CategoryId;
use Aenginus\Article\Infrastructure\ValueObjects\Id;
use Aenginus\Article\Infrastructure\ValueObjects\Promoted;
use Aenginus\Article\Infrastructure\ValueObjects\Status;
use Aenginus\Article\Infrastructure\ValueObjects\Summary;
use Aenginus\Article\Infrastructure\ValueObjects\Title;
use Aenginus\Article\Infrastructure\ValueObjects\UserId;

final readonly class ArticleEntity
{

    public string|null $id;

    public string|null $user_id;

    public string|null $title;

    public string|null $summary;

    public string|null $body;

    public string|null $category_id;

    public string $status;

    public string $promoted;


    /**
     * @param object $validatedRequest
     *
     * @throws \ReflectionException
     */
    public function __construct(object $validatedRequest)
    {
        $this->id = ! empty($validatedRequest->id)
            ? (new Id($validatedRequest->id))->value()
            : null;

        $this->user_id = ! empty($validatedRequest->user_id)
            ? (new UserId($validatedRequest->user_id))->value()
            : null;

        $this->title = ! empty($validatedRequest->title)
            ? (new Title($validatedRequest->title))->value()
            : null;

        $this->summary = ! empty($validatedRequest->summary)
            ? (new Summary($validatedRequest->summary))->value()
            : null;

        $this->body = ! empty($validatedRequest->body)
            ? (new Body($validatedRequest->body))->value()
            : null;

        $this->category_id = ! empty($validatedRequest->category)
            ? (new CategoryId($validatedRequest->category))->value()
            : null;

        $this->status = ! empty($validatedRequest->status)
            ? (new Status($validatedRequest->status))->value()
            : null;

        $this->promoted = ! empty($validatedRequest->promoted)
            ? (new Promoted($validatedRequest->promoted))->value()
            : null;
    }

}
