<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Repositories\Eloquent;

use App\Taxonomy\Domain\Contracts\UpdateContract;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use App\Taxonomy\Infrastructure\Entities\CategoryEntity;

class UpdateRepository implements UpdateContract
{

    protected CategoryEloquentModel $category;


    public function __construct(CategoryEloquentModel $category)
    {
        $this->category = $category;
    }


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     * @param \App\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function update(
        CategoryEloquentModel $category,
        CategoryEntity $entity
    ): CategoryEloquentModel
    {
        $category->update([
            'name' => $entity->name
        ]);

        return $category;
    }

}
