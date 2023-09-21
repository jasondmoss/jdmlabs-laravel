<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Domain\Contracts;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;

interface DeleteContract
{

    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     *
     * @return void
     */
    public function delete(CategoryModel $category): void;

}
