<?php

declare(strict_types=1);

namespace App\Project\Application\Repositories\Eloquent;

use App\Project\Domain\Contracts\DestroyContract;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(ProjectEloquentModel $project): void
    {
        $project->delete();
    }

}
