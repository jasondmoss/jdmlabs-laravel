<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain\Contracts;

use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

interface DeleteContract
{

    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function delete(CategoryEloquentModel $category): void;

}
