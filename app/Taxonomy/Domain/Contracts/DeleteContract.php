<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Contracts;

use App\Taxonomy\Infrastructure\Category;

interface DeleteContract
{

    /**
     * @param \App\Taxonomy\Infrastructure\Category $category
     *
     * @return void
     */
    public function delete(Category $category): void;

}
