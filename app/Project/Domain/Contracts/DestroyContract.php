<?php

declare(strict_types=1);

namespace App\Project\Domain\Contracts;

use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

interface DestroyContract
{

    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function delete(ProjectEloquentModel $project): void;

}
