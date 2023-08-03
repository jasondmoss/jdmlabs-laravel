<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Entities;


use App\Project\Infrastructure\ValueObjects\Body;
use App\Project\Infrastructure\ValueObjects\CategoryId;
use App\Project\Infrastructure\ValueObjects\ClientId;
use App\Project\Infrastructure\ValueObjects\Id;
use App\Project\Infrastructure\ValueObjects\Pinned;
use App\Project\Infrastructure\ValueObjects\Promoted;
use App\Project\Infrastructure\ValueObjects\Status;
use App\Project\Infrastructure\ValueObjects\SubTitle;
use App\Project\Infrastructure\ValueObjects\Summary;
use App\Project\Infrastructure\ValueObjects\Title;
use App\Project\Infrastructure\ValueObjects\UserId;
use App\Project\Infrastructure\ValueObjects\Website;

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

    public ?string $category_id;

    public ?string $status;

    public ?string $promoted;

    public ?string $pinned;


    /**
     * @param object $projectData
     *
     * @throws \ReflectionException
     */
    public function __construct(object $projectData)
    {
        $this->id = ! empty($projectData->id)
            ? (new Id($projectData->id))->value()
            : null;

        $this->user_id = ! empty($projectData->user_id)
            ? (new UserId($projectData->user_id))->value()
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
            ? (new ClientId($projectData->client_id))->value()
            : null;

        $this->category_id = ! empty($projectData->category_id)
            ? (new CategoryId($projectData->category_id))->value()
            : null;

        $this->status = ! empty($projectData->status)
            ? (new Status($projectData->status))->value()
            : null;

        $this->promoted = ! empty($projectData->promoted)
            ? (new Promoted($projectData->promoted))->value()
            : null;

        $this->pinned = ! empty($projectData->pinned)
            ? (new Pinned($projectData->pinned))->value()
            : null;

//        $this->status = $projectData->status;

//        $this->promoted = $projectData->promoted;

//        $this->pinned = $projectData->pinned;
    }

}
