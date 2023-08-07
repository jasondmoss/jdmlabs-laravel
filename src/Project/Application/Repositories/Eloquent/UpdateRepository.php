<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Repositories\Eloquent;

use Aenginus\Project\Domain\Contracts\UpdateContract;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;

final class UpdateRepository implements UpdateContract
{

    /**
     * @inheritDoc
     */
    public function update(
        ProjectEloquentModel $project,
        ProjectEntity $entity
    ): ProjectEloquentModel
    {
        $project->update((array) $entity);

        return $project;
    }

}
