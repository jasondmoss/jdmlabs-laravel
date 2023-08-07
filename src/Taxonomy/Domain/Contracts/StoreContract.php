<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Contracts;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;

interface StoreContract
{

    /**
     * @param object $validatedRequest
     *
     * @return \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel
     */
    public function save(object $validatedRequest): CategoryEloquentModel;

}
