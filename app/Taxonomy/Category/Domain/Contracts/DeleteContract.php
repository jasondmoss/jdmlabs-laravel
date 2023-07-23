<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Domain\Contracts;

use App\Taxonomy\Category\Infrastructure\Category;

interface DeleteContract
{

    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function delete(Category $category): void;

}
