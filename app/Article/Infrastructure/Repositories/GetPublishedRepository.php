<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;


use App\Article\Domain\Contracts\GetPublishedContract;
use App\Article\Infrastructure\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

final class GetPublishedRepository implements GetPublishedContract
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
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPublished(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->article
            ->where('status', '=', 'published')
            ->latest($column)
            ->simplePaginate($pages);
    }

}
