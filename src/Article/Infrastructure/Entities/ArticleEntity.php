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

    public string $user_id;

    public string $title;

    public string $summary;

    public string $body;

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

        $this->user_id = (new UserId($validatedRequest->user_id))->value();

        $this->title = (new Title($validatedRequest->title))->value();

        $this->summary = (new Summary($validatedRequest->summary))->value();

        $this->body = (new Body($validatedRequest->body))->value();

        $this->category_id = ! empty($validatedRequest->category)
            ? (new CategoryId($validatedRequest->category))->value()
            : null;

        $this->status = (new Status($validatedRequest->status))->value();

        $this->promoted = (new Promoted($validatedRequest->promoted))->value();
    }

}
