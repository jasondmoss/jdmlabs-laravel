<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Entities;

use App\Core\Shared\ValueObjects\Body;
use App\Core\Shared\ValueObjects\Id;
use App\Core\Shared\ValueObjects\Summary;
use App\Core\Shared\ValueObjects\Title;

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
     * @param $articleData
     */
    public function __construct($articleData)
    {
        $this->id = ! empty($articleData->id)
            ? (new Id($articleData->id))->value()
            : null;

        $this->user_id = ! empty($articleData->user_id)
            ? (new Id($articleData->user_id))->value()
            : null;

        $this->title = ! empty($articleData->title)
            ? (new Title($articleData->title))->value()
            : null;

        $this->summary = ! empty($articleData->summary)
            ? (new Summary($articleData->summary))->value()
            : null;

        $this->body = ! empty($articleData->body)
            ? (new Body($articleData->body))->value()
            : null;

        $this->category = ! empty($articleData->category)
            ? (new Id($articleData->category))->value()
            : null;

        $this->status = $articleData->status;

        $this->promoted = $articleData->promoted;
    }

}
