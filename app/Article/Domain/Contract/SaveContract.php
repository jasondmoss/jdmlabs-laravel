<?php

declare(strict_types=1);

namespace App\Article\Domain\Contract;

use App\Article\Infrastructure\Article;
use App\Article\Interface\ArticleFormRequest;

interface SaveContract
{

    /**
     *
     * @param \App\Article\Interface\ArticleFormRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function save(ArticleFormRequest $data): Article;

}
