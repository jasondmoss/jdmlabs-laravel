<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Repositories\Eloquent;

use Aenginus\Taxonomy\Domain\Contracts\DeleteContract;
use Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

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
