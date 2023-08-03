<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\Entities\ArticleEntity;

interface StoreContract
{

    /**
     * @param \App\Article\Infrastructure\Entities\ArticleEntity $entity
     *
     * @return \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function save(ArticleEntity $entity): ArticleEloquentModel;

}
