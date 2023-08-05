<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Contracts;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

interface StoreContract
{

    /**
     * @param object $projectEntity
     *
     * @return \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel
     */
    public function save(object $projectEntity): ProjectEloquentModel;

}
