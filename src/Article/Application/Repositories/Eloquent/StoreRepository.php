<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Repositories\Eloquent;

use Aenginus\Article\Domain\Contracts\StoreContract;
use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

final class StoreRepository implements StoreContract
{
    /**
     * @inheritDoc
     */
    public function save(ArticleEntity $entity): ArticleModel
    {
        return ArticleModel::create((array) $entity);
    }
}
