<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure\Repositories;

use App\Taxonomy\Category\Domain\Contracts\StoreContract;
use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\Requests\Http\CategoryRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class StoreRepository implements StoreContract
{

    /**
     * @param \App\Taxonomy\Category\Interface\Requests\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function save(CategoryRequest $data): Category
    {
        $category = Category::create([
            'name' => $data->name,
            'slug' => $data->slug,
            'order' => $data->order
        ]);

        return Category::findOrFail($category->id);
    }

}
