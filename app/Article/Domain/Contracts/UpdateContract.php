<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Article;
use App\Article\Interface\Http\UpdateRequest;

interface UpdateContract
{

    /**
     *
     * @param \App\Article\Interface\Http\UpdateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function update(UpdateRequest $data): Article;

}
