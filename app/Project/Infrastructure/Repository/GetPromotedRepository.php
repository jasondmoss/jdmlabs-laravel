<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repository;

use App\Project\Domain\Contract\GetPromotedContract;
use App\Project\Infrastructure\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPromotedRepository implements GetPromotedContract
{

    private Project $model;


    public function __construct()
    {
        $this->model = new Project;
    }


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPromoted(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->model
            ->where('promoted', '=', 'promoted')
            ->latest($column)
            ->simplePaginate($pages);
    }

}
