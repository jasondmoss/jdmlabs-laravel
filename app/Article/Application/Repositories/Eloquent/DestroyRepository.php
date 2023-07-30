<?php

declare(strict_types=1);

namespace App\Article\Application\Repositories\Eloquent;

use App\Article\Domain\Contracts\DestroyContract;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(ArticleEloquentModel $article): void
    {
        $article->delete();
    }

}
