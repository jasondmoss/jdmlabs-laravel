<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Domain\Contract;

use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\CategoryFormRequest;

interface SaveContract
{

    /**
     * @param \App\Taxonomy\Category\Interface\CategoryFormRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function save(CategoryFormRequest $data): Category;

}
