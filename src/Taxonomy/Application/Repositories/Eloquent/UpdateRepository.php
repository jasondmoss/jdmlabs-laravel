<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Repositories\Eloquent;

use Aenginus\Taxonomy\Domain\Contracts\UpdateContract;
use Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;

final class UpdateRepository implements UpdateContract
{

    private CategoryEloquentModel $category;


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     */
    public function __construct(CategoryEloquentModel $category)
    {
        $this->category = $category;
    }


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     * @param \Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function update(
        CategoryEloquentModel $category,
        CategoryEntity $entity
    ): CategoryEloquentModel
    {
        $this->category->update((array) $entity);

        return $category;
    }

}
