<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Repositories\Eloquent;

use Aenginus\Project\Domain\Contracts\UpdateContract;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;

final class UpdateRepository implements UpdateContract
{

    /**
     * @inheritDoc
     */
    public function update(ProjectModel $project, ProjectEntity $entity): ProjectModel
    {
        $project->update((array)$entity);

        return $project;
    }

}
