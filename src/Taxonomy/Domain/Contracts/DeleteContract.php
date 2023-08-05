<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Contracts;

use Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

interface DeleteContract
{

    /**
     * @param \Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function delete(CategoryEloquentModel $category): void;

}
