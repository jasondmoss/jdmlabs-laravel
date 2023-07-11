<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repository;

use App\Client\Infrastructure\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPublishedRepository implements \App\Client\Domain\Contract\GetPublishedContract
{

    private Client $model;


    public function __construct()
    {
        $this->model = new Client;
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
            ->where('status', 'published')
            ->latest($column)
            ->simplePaginate($pages);
    }

}