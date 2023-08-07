<?php

declare(strict_types=1);

namespace Aenginus\Project\Infrastructure\Entities;

use Aenginus\Project\Infrastructure\ValueObjects;

final readonly class ProjectEntity
{

    public string|null $id;

    public string $user_id;

    public string $title;

    public string $subtitle;

    public string $website;

    public string $summary;

    public string $body;

    public string $client_id;

    public string|null $category_id;

    public string $status;

    public string $promoted;

    public string $pinned;


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

        $this->user_id = (new ValueObjects\UserId($projectData->user_id))->value();

        $this->title = (new ValueObjects\Title($projectData->title))->value();

        $this->subtitle = (new ValueObjects\SubTitle($projectData->subtitle))->value();

        $this->website = (new ValueObjects\Website($projectData->website))->value();

        $this->summary = (new ValueObjects\Summary($projectData->summary))->value();

        $this->body = (new ValueObjects\Body($projectData->body))->value();

        $this->client_id = (new ValueObjects\ClientId($projectData->client_id))->value();

        $this->category_id = ! empty($projectData->category_id)
            ? (new ValueObjects\CategoryId($projectData->category_id))->value()
            : null;

        $this->status = (new ValueObjects\Status($projectData->status))->value();

        $this->promoted = (new ValueObjects\Promoted($projectData->promoted))->value();

        $this->pinned = (new ValueObjects\Pinned($projectData->pinned))->value();
    }

}
