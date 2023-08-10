<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Repositories\Eloquent;

use Aenginus\Taxonomy\Domain\Contracts\StoreContract;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;

final class StoreRepository implements StoreContract
{

    /**
     * @param object $validatedRequest
     *
     * @return \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel
     */
    public function save(object $validatedRequest): CategoryEloquentModel
    {
        return CategoryEloquentModel::create((array) $validatedRequest);
    }

}