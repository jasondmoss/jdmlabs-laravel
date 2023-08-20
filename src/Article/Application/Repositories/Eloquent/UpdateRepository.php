<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Repositories\Eloquent;

use Aenginus\Article\Domain\Contracts\UpdateContract;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

final class UpdateRepository implements UpdateContract
{

    /**
     * @inheritDoc
     */
    public function update(ArticleEloquentModel $article, ArticleEntity $entity): ArticleEloquentModel
    {
        $article->update((array) $entity);

        return $article;
    }

}
