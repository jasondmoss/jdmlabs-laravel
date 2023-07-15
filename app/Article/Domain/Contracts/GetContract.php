<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Article;

interface GetContract
{

    /**
     * @param string $key
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function get(string $key): Article;

}
