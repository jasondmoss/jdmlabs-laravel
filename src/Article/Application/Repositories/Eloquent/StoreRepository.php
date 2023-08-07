<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Repositories\Eloquent;

use Aenginus\Article\Domain\Contracts\StoreContract;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

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
