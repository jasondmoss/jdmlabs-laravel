<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure\Repositories;

use App\Taxonomy\Category\Domain\Contracts\StoreContract;
use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\Requests\Http\CategoryRequest;

class UpdateRepository implements StoreContract
{

    protected Category $category;


    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\Requests\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     * @throws \App\Taxonomy\Category\Application\Exceptions\CouldNotFindCategory
     */
    public function update(CategoryRequest $data): Category
    {
        $instance = $this->category->find($data->input('id'));

        $instance->update([
            'name' => $data->name,
            'slug' => $data->slug,
            'order' => $data->order
        ]);

        return Category::findOrFail($instance->id);
    }

}
