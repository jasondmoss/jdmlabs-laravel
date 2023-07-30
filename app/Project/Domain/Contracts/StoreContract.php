<?php

declare(strict_types=1);

namespace App\Project\Domain\Contracts;

use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

interface StoreContract
{

    /**
     * @param object $data
     *
     * @return \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel
     */
    public function save(object $data): ProjectEloquentModel;

}
