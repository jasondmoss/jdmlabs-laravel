<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Domain\Model\ProjectModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Project\Domain\Model\ProjectModel $project
     * @param \Aenginus\Project\Infrastructure\Entities\ProjectEntity $entity
     *
     * @return \Aenginus\Project\Domain\Model\ProjectModel
     */
    public function update(ProjectModel $project, ProjectEntity $entity): ProjectModel;

}
