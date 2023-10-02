<?php

declare(strict_types=1);

namespace Aenginus\Article\Infrastructure\Entities;

use Aenginus\Shared\ValueObjects\PromotedValueObject;
use Aenginus\Shared\ValueObjects\StatusValueObject;
use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UlidValueObject;

final readonly class ArticleEntity
{

    public ?string $id;

    public string $user_id;

    public string $title;

    public string $summary;

    public string $body;

    public ?string $category_id;

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
            ? (new UlidValueObject($validatedRequest->id))->value()
            : null;
        $this->user_id = (new UlidValueObject($validatedRequest->user_id))->value();
        $this->title = (new StringValueObject($validatedRequest->title))->value();
        $this->summary = (new StringValueObject($validatedRequest->summary))->value();
        $this->body = (new StringValueObject($validatedRequest->body))->value();
        $this->category_id = ! empty($validatedRequest->category)
            ? (new UlidValueObject($validatedRequest->category))->value()
            : null;
        $this->status = (new StatusValueObject($validatedRequest->status))->value();
        $this->promoted = (new PromotedValueObject($validatedRequest->promoted))->value();
    }

}
