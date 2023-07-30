<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\Entities\ArticleEntity;

interface UpdateContract
{

    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     * @param ArticleEntity $entity
     *
     * @return \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function update(
        ArticleEloquentModel $article,
        ArticleEntity $entity
    ): ArticleEloquentModel;

}
