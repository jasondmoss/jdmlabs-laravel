<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Repositories\Eloquent;

use Aenginus\Article\Domain\Contracts\UpdateContract;
use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

final class UpdateRepository implements UpdateContract
{

    /**
     * @inheritDoc
     */
    public function update(ArticleModel $article, ArticleEntity $entity): ArticleModel
    {
        $article->update((array)$entity);

        return $article;
    }

}
