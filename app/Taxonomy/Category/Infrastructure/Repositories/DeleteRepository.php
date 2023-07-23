<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure\Repositories;

use App\Taxonomy\Category\Domain\Contracts\DeleteContract;
use App\Taxonomy\Category\Infrastructure\Category;

final class DeleteRepository implements DeleteContract
{

    /**
     * @inheritDoc
     */
    public function delete(Category $category): void
    {
        $category->delete();
    }

}
