<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\GetPromotedContract;
use App\Article\Infrastructure\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

final class GetPromotedRepository implements GetPromotedContract
{

    private Article $article;


    public function __construct()
    {
        $this->article = new Article;
    }


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Pagination\Paginator
     */
    public function getPromoted(string $column = 'id', int $pages = 10): Builder|Paginator
    {
        return $this->article
            ->where('promoted', '=', 'promoted')
            ->latest($column)
            ->simplePaginate($pages);
    }

}
