<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Domain\Contracts;

use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\Http\CategoryRequest;

interface StoreContract
{

    /**
     * @param \App\Taxonomy\Category\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function save(CategoryRequest $data): Category;

}
