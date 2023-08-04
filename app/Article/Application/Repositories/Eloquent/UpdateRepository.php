<?php

declare(strict_types=1);

namespace App\Article\Application\Repositories\Eloquent;

use App\Article\Domain\Contracts\UpdateContract;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\Entities\ArticleEntity;

final class UpdateRepository implements UpdateContract
{

    protected ArticleEloquentModel $article;


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     */
    public function __construct(ArticleEloquentModel $article)
    {
        $this->article = $article;
    }


    /**
     * @inheritDoc
     */
    public function update(ArticleEloquentModel $article, ArticleEntity $entity): ArticleEloquentModel
    {
        $article->update((array) $entity);

        return $article;
    }

}
