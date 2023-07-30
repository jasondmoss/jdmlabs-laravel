<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

interface StoreContract
{

    /**
     *
     * @param object $data
     *
     * @return \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function save(object $data): ArticleEloquentModel;

}
