<?php

declare(strict_types=1);

namespace App\Project\Application\Repositories\Eloquent;

use App\Project\Domain\Contracts\UpdateContract;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Project\Infrastructure\Entities\ProjectEntity;

final class UpdateRepository implements UpdateContract
{

    protected ProjectEloquentModel $project;


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     */
    public function __construct(ProjectEloquentModel $project)
    {
        $this->project = $project;
    }


    /**
     * @inheritDoc
     */
    public function update(ProjectEloquentModel $project, ProjectEntity $entity): ProjectEloquentModel
    {
        $project->update([
            'user_id' => $entity->user_id,
            'title' => $entity->title,
            'subtitle' => $entity->subtitle,
            'website' => $entity->website,
            'summary' => $entity->summary,
            'body' => $entity->body,
            'client_id' => $entity->client_id,
            'category_id' => $entity->category_id,
            'status' => $entity->status,
            'promoted' => $entity->promoted,
            'pinned' => $entity->pinned,
        ]);

        return $project;
    }

}
