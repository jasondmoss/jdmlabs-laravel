<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Contracts;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;

interface DeleteContract
{

    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     *
     * @return void
     */
    public function delete(CategoryEloquentModel $category): void;

}
