<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Contracts;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;

interface UpdateContract
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
    ): CategoryEloquentModel;

}
