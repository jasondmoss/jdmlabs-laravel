<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Contracts;

use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use App\Taxonomy\Infrastructure\Entities\CategoryEntity;

interface UpdateContract
{

    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     * @param \App\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function update(CategoryEloquentModel $category, CategoryEntity $entity): CategoryEloquentModel;

}
