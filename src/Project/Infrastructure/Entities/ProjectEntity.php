<?php

declare(strict_types=1);

namespace Aenginus\Project\Infrastructure\Entities;

use Aenginus\Shared\ValueObjects\PinnedValueObject;
use Aenginus\Shared\ValueObjects\PromotedValueObject;
use Aenginus\Shared\ValueObjects\StatusValueObject;
use Aenginus\Shared\ValueObjects\StringValueObject;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Shared\ValueObjects\UrlValueObject;

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
            ? (new UlidValueObject($projectData->id))->value()
            : null;
        $this->user_id = (new UlidValueObject($projectData->user_id))->value();
        $this->title = (new StringValueObject($projectData->title))->value();
        $this->subtitle = (new StringValueObject($projectData->subtitle))->value();
        $this->website = (new UrlValueObject($projectData->website))->value();
        $this->summary = (new StringValueObject($projectData->summary))->value();
        $this->body = (new StringValueObject($projectData->body))->value();
        $this->client_id = (new UlidValueObject($projectData->client_id))->value();
        $this->category_id = ! empty($projectData->category_id)
            ? (new UlidValueObject($projectData->category_id))->value()
            : null;
        $this->status = (new StatusValueObject($projectData->status))->value();
        $this->promoted = (new PromotedValueObject($projectData->promoted))->value();
        $this->pinned = (new PinnedValueObject($projectData->pinned))->value();
    }

}
