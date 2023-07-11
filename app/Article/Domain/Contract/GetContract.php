<?php

declare(strict_types=1);

namespace App\Article\Domain\Contract;

use App\Article\Infrastructure\Article;

interface GetContract
{

    /**
     * @param string $key
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function get(string $key): Article;

}
