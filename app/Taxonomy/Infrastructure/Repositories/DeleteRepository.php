<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Repositories;

use App\Taxonomy\Domain\Contracts\DeleteContract;
use App\Taxonomy\Infrastructure\Category;

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
