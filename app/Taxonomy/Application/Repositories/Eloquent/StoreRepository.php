<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Repositories\Eloquent;

use App\Taxonomy\Domain\Contracts\StoreContract;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

class StoreRepository implements StoreContract
{

    /**
     * @param object $data
     *
     * @return \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function save(object $data): CategoryEloquentModel
    {
        return CategoryEloquentModel::create([
            'name' => $data->name
        ]);
    }

}
