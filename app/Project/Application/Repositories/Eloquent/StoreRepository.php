<?php

declare(strict_types=1);

namespace App\Project\Application\Repositories\Eloquent;

use App\Project\Domain\Contracts\StoreContract;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

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
