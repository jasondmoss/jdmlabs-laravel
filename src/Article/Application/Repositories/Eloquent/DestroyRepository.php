<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Repositories\Eloquent;

use Aenginus\Article\Domain\Contracts\DestroyContract;
use Aenginus\Article\Domain\Models\ArticleModel;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(ArticleModel $article): void
    {
        $article->delete();
    }

}
