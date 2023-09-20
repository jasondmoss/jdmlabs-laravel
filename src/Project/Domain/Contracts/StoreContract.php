<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Domain\Model\ProjectModel;

interface StoreContract
{

    /**
     * @param object $projectEntity
     *
     * @return \Aenginus\Project\Domain\Model\ProjectModel
     */
    public function save(object $projectEntity): ProjectModel;

}
