<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Contracts;

use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     * @param ArticleEntity $entity
     *
     * @return \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function update(
        ArticleEloquentModel $article,
        ArticleEntity $entity
    ): ArticleEloquentModel;

}
