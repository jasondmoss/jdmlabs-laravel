<?php

declare(strict_types=1);

namespace App\Project\Domain\Contract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

interface GetPinnedContract
{

    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPinned(string $column = 'id', int $pages = 10): Paginator|Builder;

}
