<?php

declare(strict_types=1);

namespace App\Article\Domain\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface GetRelatedContract
{

    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection
     */
    public function getRelated(mixed $data): Model|Builder|Collection;

}
