<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Entities;

use App\Core\Shared\ValueObjects\Body;
use App\Core\Shared\ValueObjects\Id;
use App\Core\Shared\ValueObjects\SubTitle;
use App\Core\Shared\ValueObjects\Summary;
use App\Core\Shared\ValueObjects\Title;
use App\Core\Shared\ValueObjects\Website;

final readonly class ProjectEntity
{

    public ?string $id;

    public ?string $user_id;

    public ?string $title;

    public ?string $subtitle;

    public ?string $website;

    public ?string $summary;

    public ?string $body;

    public ?string $client_id;

    public ?string $category;

    public ?string $status;

    public ?string $promoted;

    public ?string $pinned;


    /**
     * @param object $projectData
     */
    public function __construct(object $projectData)
    {
        $this->id = ! empty($projectData->id)
            ? (new Id($projectData->id))->value()
            : null;

        $this->user_id = ! empty($projectData->user_id)
            ? (new Id($projectData->user_id))->value()
            : null;

        $this->title = ! empty($projectData->title)
            ? (new Title($projectData->title))->value()
            : null;

        $this->subtitle = ! empty($projectData->subtitle)
            ? (new SubTitle($projectData->subtitle))->value()
            : null;

        $this->website = ! empty($projectData->website)
            ? (new Website($projectData->website))->value()
            : null;

        $this->summary = ! empty($projectData->summary)
            ? (new Summary($projectData->summary))->value()
            : null;

        $this->body = ! empty($projectData->body)
            ? (new Body($projectData->body))->value()
            : null;

        $this->client_id = ! empty($projectData->client_id)
            ? (new Id($projectData->client_id))->value()
            : null;

        $this->category = ! empty($projectData->category)
            ? (new Id($projectData->category))->value()
            : null;

        $this->status = $projectData->status;

        $this->promoted = $projectData->promoted;

        $this->pinned = $projectData->pinned;

    }
}
