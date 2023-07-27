<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Repositories;

use App\Taxonomy\Domain\Contracts\StoreContract;
use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Interface\Http\CategoryRequest;

class StoreRepository implements StoreContract
{

    /**
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Infrastructure\Category
     */
    public function save(CategoryRequest $data): Category
    {
        $category = Category::create([
            'name' => $data->name,
            'slug' => $data->slug
        ]);

        return Category::findOrFail($category->id);
    }

}
