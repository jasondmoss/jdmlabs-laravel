<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Repositories\Eloquent;

use Aenginus\Project\Domain\Contracts\StoreContract;
use Aenginus\Project\Domain\Models\ProjectModel;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(object $projectEntity): ProjectModel
    {
        return ProjectModel::create((array)$projectEntity);
    }

}
