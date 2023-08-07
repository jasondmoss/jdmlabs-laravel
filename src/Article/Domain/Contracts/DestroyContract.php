<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Contracts;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     *
     * @return void
     */
    public function delete(ArticleEloquentModel $article): void;

}
