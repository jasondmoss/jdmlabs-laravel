<?php

declare(strict_types=1);

namespace Aenginus\Project\Infrastructure\Entities;

use Aenginus\Project\Infrastructure\ValueObjects;

final readonly class ProjectEntity
{

    public string|null $id;

    public string|null $user_id;

    public string|null $title;

    public string|null $subtitle;

    public string|null $website;

    public string|null $summary;

    public string|null $body;

    public string|null $client_id;

    public string|null $category_id;

    public string|null $status;

    public string|null $promoted;

    public string|null $pinned;


    /**
     * @param object $projectData
     *
     * @throws \ReflectionException
     */
    public function __construct(object $projectData)
    {
        $this->id = ! empty($projectData->id)
            ? (new ValueObjects\Id($projectData->id))->value()
            : null;

        $this->user_id = ! empty($projectData->user_id)
            ? (new ValueObjects\UserId($projectData->user_id))->value()
            : null;

        $this->title = ! empty($projectData->title)
            ? (new ValueObjects\Title($projectData->title))->value()
            : null;

        $this->subtitle = ! empty($projectData->subtitle)
            ? (new ValueObjects\SubTitle($projectData->subtitle))->value()
            : null;

        $this->website = ! empty($projectData->website)
            ? (new ValueObjects\Website($projectData->website))->value()
            : null;

        $this->summary = ! empty($projectData->summary)
            ? (new ValueObjects\Summary($projectData->summary))->value()
            : null;

        $this->body = ! empty($projectData->body)
            ? (new ValueObjects\Body($projectData->body))->value()
            : null;

        $this->client_id = ! empty($projectData->client_id)
            ? (new ValueObjects\ClientId($projectData->client_id))->value()
            : null;

        $this->category_id = ! empty($projectData->category_id)
            ? (new ValueObjects\CategoryId($projectData->category_id))->value()
            : null;

        $this->status = ! empty($projectData->status)
            ? (new ValueObjects\Status($projectData->status))->value()
            : null;

        $this->promoted = ! empty($projectData->promoted)
            ? (new ValueObjects\Promoted($projectData->promoted))->value()
            : null;

        $this->pinned = ! empty($projectData->pinned)
            ? (new ValueObjects\Pinned($projectData->pinned))->value()
            : null;
    }

}
