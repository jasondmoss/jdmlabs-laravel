<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function delete(ProjectEloquentModel $project): void;

}
