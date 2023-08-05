<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Repositories\Eloquent;

use Aenginus\Article\Domain\Contracts\UpdateContract;
use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

final class UpdateRepository implements UpdateContract
{

    private ArticleEloquentModel $article;


    /**
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
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
