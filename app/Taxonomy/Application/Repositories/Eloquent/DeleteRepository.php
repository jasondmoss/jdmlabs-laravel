<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Repositories\Eloquent;

use App\Taxonomy\Domain\Contracts\DeleteContract;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

final class DeleteRepository implements DeleteContract
{

    /**
     * @inheritDoc
     */
    public function delete(CategoryEloquentModel $category): void
    {
        $category->delete();
    }

}
