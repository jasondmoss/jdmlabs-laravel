<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Repositories\Eloquent;

use Aenginus\Project\Domain\Contracts\StoreContract;
use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(object $projectEntity): ProjectEloquentModel
    {
        return ProjectEloquentModel::create((array) $projectEntity);
    }

}
