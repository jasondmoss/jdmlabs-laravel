<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Contracts;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     * @param \Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \Aenginus\Taxonomy\Domain\Models\CategoryModel
     */
    public function update(CategoryModel $category, CategoryEntity $entity): CategoryModel;

}
