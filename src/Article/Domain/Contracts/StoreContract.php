<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Contracts;

use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

interface StoreContract
{

    /**
     * @param \Aenginus\Article\Infrastructure\Entities\ArticleEntity $entity
     *
     * @return \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function save(ArticleEntity $entity): ArticleEloquentModel;

}
