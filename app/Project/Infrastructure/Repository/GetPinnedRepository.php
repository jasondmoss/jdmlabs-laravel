<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repository;

use App\Project\Domain\Contract\GetPinnedContract;
use App\Project\Infrastructure\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPinnedRepository implements GetPinnedContract
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
    public function getPinned(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->model
            ->where('pinned', '=', 'pinned')
            ->latest($column)
            ->simplePaginate($pages);
    }

}
