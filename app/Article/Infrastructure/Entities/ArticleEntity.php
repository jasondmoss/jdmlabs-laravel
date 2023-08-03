<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Entities;

use App\Article\Infrastructure\ValueObjects\Body;
use App\Article\Infrastructure\ValueObjects\CategoryId;
use App\Article\Infrastructure\ValueObjects\Id;
use App\Article\Infrastructure\ValueObjects\Promoted;
use App\Article\Infrastructure\ValueObjects\Status;
use App\Article\Infrastructure\ValueObjects\Summary;
use App\Article\Infrastructure\ValueObjects\Title;
use App\Article\Infrastructure\ValueObjects\UserId;

final readonly class ArticleEntity
{

    public ?string $id;

    public ?string $user_id;

    public ?string $title;

    public ?string $summary;

    public ?string $body;

    public ?string $category;

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

        $this->category = ! empty($validatedRequest->category)
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
