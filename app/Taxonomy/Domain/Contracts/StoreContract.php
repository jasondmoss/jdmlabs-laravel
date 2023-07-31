<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Contracts;

use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

interface StoreContract
{

    /**
     * @param object $data
     *
     * @return \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function save(object $data): CategoryEloquentModel;

}
