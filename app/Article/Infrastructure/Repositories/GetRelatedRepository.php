<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\GetRelatedContract;
use App\Article\Infrastructure\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class GetRelatedRepository implements GetRelatedContract
{

    private Article $article;


    public function __construct()
    {
        $this->article = new Article;
    }


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function getRelated(mixed $data): Builder|Model|Collection
    {
        return $this->article->where('category_id', $data->category_id)
            ->where('status', '=', 1)
            ->where('id', '!=', $data->id)
            ->latest('id')
            ->take(4)
            ->get();
    }

}
