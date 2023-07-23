<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repositories;

use App\Project\Domain\Contracts\DestroyContract;
use App\Project\Infrastructure\Project;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(Project $project): void
    {
        $project->delete();
    }

}
