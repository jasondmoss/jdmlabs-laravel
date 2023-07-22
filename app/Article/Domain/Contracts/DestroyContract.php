<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Article;

interface DestroyContract
{

    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function delete(Article $article): void;

}
