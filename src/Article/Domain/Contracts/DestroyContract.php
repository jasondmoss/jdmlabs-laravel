<?php

declare(strict_types=1);

namespace Aenginus\Article\Domain\Contracts;

use Aenginus\Article\Domain\Models\ArticleModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     *
     * @return void
     */
    public function delete(ArticleModel $article): void;

}
