<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Domain\Models\ProjectModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     *
     * @return void
     */
    public function delete(ProjectModel $project): void;

}
