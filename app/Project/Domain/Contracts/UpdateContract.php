<?php

declare(strict_types=1);

namespace App\Project\Domain\Contracts;

use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Project\Infrastructure\Entities\ProjectEntity;

interface UpdateContract
{

    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     * @param \App\Project\Infrastructure\Entities\ProjectEntity $entity
     *
     * @return \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel
     */
    public function update(ProjectEloquentModel $project, ProjectEntity $entity): ProjectEloquentModel;

}
