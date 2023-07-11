<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Domain;

use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\CategoryFormRequest;

interface CategoryRepositoryContract
{

    /**
     * @param string $key
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function get(string $key): Category;


    /**
     * @param \App\Taxonomy\Category\Interface\CategoryFormRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function save(CategoryFormRequest $data): Category;


    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void;

}
