<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure;

use App\Taxonomy\Category\Domain\CategoryRepositoryContract;
use App\Taxonomy\Category\Interface\CategoryFormRequest;

final class CategoryRepository implements CategoryRepositoryContract
{


    /**
     * @param string $key
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function get(string $key): Category
    {
        // TODO: Implement get() method.
    }


    /**
     * @inheritDoc
     */
    public function save(CategoryFormRequest $data): Category
    {
        // TODO: Implement save() method.
    }


    /**
     * @inheritDoc
     */
    public function delete(string $id): void
    {
        // TODO: Implement delete() method.
    }

}
