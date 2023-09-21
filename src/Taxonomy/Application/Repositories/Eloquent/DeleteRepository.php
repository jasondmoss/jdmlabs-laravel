<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Repositories\Eloquent;

use Aenginus\Taxonomy\Domain\Contracts\DeleteContract;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;

final class DeleteRepository implements DeleteContract
{

    /**
     * @inheritDoc
     */
    public function delete(CategoryModel $category): void
    {
        $category->delete();
    }

}
