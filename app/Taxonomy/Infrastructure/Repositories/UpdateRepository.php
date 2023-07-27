<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Repositories;

use App\Taxonomy\Domain\Contracts\UpdateContract;
use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Interface\Http\CategoryRequest;

class UpdateRepository implements UpdateContract
{

    protected Category $category;


    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    /**
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Infrastructure\Category
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    public function update(CategoryRequest $data): Category
    {
        $instance = $this->category->find($data->id);

        $instance->update([
            'name' => $data->name,
            'slug' => $data->slug
        ]);

        return Category::findOrFail($instance->id);
    }

}
