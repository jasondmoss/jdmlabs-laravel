<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Repositories\Eloquent;

use Aenginus\Taxonomy\Domain\Contracts\UpdateContract;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;

final class UpdateRepository implements UpdateContract
{

    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     * @param \Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \Aenginus\Taxonomy\Domain\Models\CategoryModel
     */
    public function update(CategoryModel $category, CategoryEntity $entity): CategoryModel
    {
        $category->update((array) $entity);

        return $category;
    }

}
