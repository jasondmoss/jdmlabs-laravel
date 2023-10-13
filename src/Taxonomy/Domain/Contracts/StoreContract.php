<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Contracts;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;

interface StoreContract
{
    /**
     * @param object $validatedRequest
     *
     * @return \Aenginus\Taxonomy\Domain\Models\CategoryModel
     */
    public function save(object $validatedRequest): CategoryModel;
}
