<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Repositories\Eloquent;

use Aenginus\Project\Domain\Contracts\DestroyContract;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;

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
