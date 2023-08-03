<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Repositories\Eloquent;

use App\Taxonomy\Domain\Contracts\StoreContract;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

class StoreRepository implements StoreContract
{

    /**
     * @param object $validatedRequest
     *
     * @return \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function save(object $validatedRequest): CategoryEloquentModel
    {
        return CategoryEloquentModel::create([
            'name' => $validatedRequest->name
        ]);
    }

}
