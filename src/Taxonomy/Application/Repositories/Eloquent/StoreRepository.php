<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Repositories\Eloquent;

use Aenginus\Taxonomy\Domain\Contracts\StoreContract;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;

final class StoreRepository implements StoreContract
{
    /**
     * @param object $validatedRequest
     *
     * @return \Aenginus\Taxonomy\Domain\Models\CategoryModel
     */
    public function save(object $validatedRequest): CategoryModel
    {
        return CategoryModel::create((array) $validatedRequest);
    }
}
