<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     *
     * @return void
     */
    public function delete(ProjectEloquentModel $project): void;

}
