<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Repositories\Eloquent;

use Aenginus\Project\Domain\Contracts\DestroyContract;
use Aenginus\Project\Domain\Models\ProjectModel;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(ProjectModel $project): void
    {
        $project->delete();
    }

}
