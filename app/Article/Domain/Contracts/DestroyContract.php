<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

interface DestroyContract
{

    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function delete(ArticleEloquentModel $article): void;

}
