<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Article;

interface UpdateContract
{

    /**
     * @param object $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function update(object $data): Article;

}
