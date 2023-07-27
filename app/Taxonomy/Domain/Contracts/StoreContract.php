<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Contracts;

use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Interface\Http\CategoryRequest;

interface StoreContract
{

    /**
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Infrastructure\Category
     */
    public function save(CategoryRequest $data): Category;

}
