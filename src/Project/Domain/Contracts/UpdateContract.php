<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     * @param \Aenginus\Project\Infrastructure\Entities\ProjectEntity $entity
     *
     * @return \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel
     */
    public function update(
        ProjectEloquentModel $project,
        ProjectEntity $entity
    ): ProjectEloquentModel;

}
