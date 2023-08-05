<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Repositories\Eloquent;

use Aenginus\Article\Domain\Contracts\DestroyContract;
use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

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
