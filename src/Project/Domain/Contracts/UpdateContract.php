<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     * @param \Aenginus\Project\Infrastructure\Entities\ProjectEntity $entity
     *
     * @return \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel
     */
    public function update(ProjectEloquentModel $project, ProjectEntity $entity): ProjectEloquentModel;

}
