<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repository;


use App\Article\Domain\Contract\GetPublishedContract;
use App\Article\Infrastructure\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

final class GetPublishedRepository implements GetPublishedContract
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
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPublished(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->model
            ->where('status', '=', 'published')
            ->latest($column)
            ->simplePaginate($pages);
    }

}
