<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Article;
use App\Article\Interface\Requests\Http\UpdateRequest;

interface UpdateContract
{

    /**
     *
     * @param \App\Article\Interface\Requests\Http\UpdateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function save(UpdateRequest $data): Article;

}
