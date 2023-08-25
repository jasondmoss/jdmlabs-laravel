<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Contracts;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     * @param ArticleEntity $entity
     *
     * @return \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel
     */
    public function update(ArticleEloquentModel $article, ArticleEntity $entity): ArticleEloquentModel;

}
