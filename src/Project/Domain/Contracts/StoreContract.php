<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;

interface StoreContract
{

    /**
     * @param object $projectEntity
     *
     * @return \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel
     */
    public function save(object $projectEntity): ProjectEloquentModel;

}
