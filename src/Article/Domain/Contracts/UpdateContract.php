<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Contracts;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

interface UpdateContract
{
    /**
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     * @param ArticleEntity $entity
     *
     * @return \Aenginus\Article\Domain\Models\ArticleModel
     */
    public function update(ArticleModel $article, ArticleEntity $entity): ArticleModel;
}
