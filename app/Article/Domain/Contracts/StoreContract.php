<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Article;
use App\Article\Interface\Http\CreateRequest;

interface StoreContract
{

    /**
     *
     * @param \App\Article\Interface\Http\CreateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function save(CreateRequest $data): Article;

}
