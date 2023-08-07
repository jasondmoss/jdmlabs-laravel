<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Repositories\Eloquent;

use Aenginus\Taxonomy\Domain\Contracts\UpdateContract;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;

final class UpdateRepository implements UpdateContract
{

    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     * @param \Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel
     */
    public function update(
        CategoryEloquentModel $category,
        CategoryEntity $entity
    ): CategoryEloquentModel
    {
        $category->update((array) $entity);

        return $category;
    }

}
