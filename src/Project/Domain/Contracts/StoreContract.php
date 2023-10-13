<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Domain\Models\ProjectModel;

interface StoreContract
{
    /**
     * @param object $projectEntity
     *
     * @return \Aenginus\Project\Domain\Models\ProjectModel
     */
    public function save(object $projectEntity): ProjectModel;
}
