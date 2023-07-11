<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repository;

use App\Article\Domain\Contract\GetPromotedContract;
use App\Article\Infrastructure\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

final class GetPromotedRepository implements GetPromotedContract
{

    private Article $model;


    public function __construct()
    {
        $this->model = new Article;
    }


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Pagination\Paginator
     */
    public function getPromoted(string $column = 'id', int $pages = 10): Builder|Paginator
    {
        return $this->model
            ->where('promoted', '=', 'promoted')
            ->latest($column)
            ->simplePaginate($pages);
    }

}
