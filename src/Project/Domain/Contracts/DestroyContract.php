<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Domain\Model\ProjectModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Project\Domain\Model\ProjectModel $project
     *
     * @return void
     */
    public function delete(ProjectModel $project): void;

}
