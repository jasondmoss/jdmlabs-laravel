<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\DestroyContract;
use App\Article\Infrastructure\Article;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(Article $article): void
    {
        $article->delete();
    }

}
