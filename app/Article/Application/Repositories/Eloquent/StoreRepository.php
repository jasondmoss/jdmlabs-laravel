<?php

declare(strict_types=1);

namespace App\Article\Application\Repositories\Eloquent;

use App\Article\Domain\Contracts\StoreContract;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\Entities\ArticleEntity;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(ArticleEntity $entity): ArticleEloquentModel
    {
        return ArticleEloquentModel::create((array) $entity);
    }

}
