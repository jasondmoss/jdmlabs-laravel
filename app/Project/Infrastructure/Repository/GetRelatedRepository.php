<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repository;

use App\Project\Domain\Contract\GetRelatedContract;
use App\Project\Infrastructure\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetRelatedRepository implements GetRelatedContract
{

    private Project $model;


    public function __construct()
    {
        $this->model = new Project;
    }


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection
     */
    public function getRelated(mixed $data): Model|Builder|Collection
    {
        return $this->model->where('category_id', $data->category_id)
            ->where('status', '=', 1)
            ->where('id', '!=', $data->id)
            ->latest('id')
            ->take(4)
            ->get();
    }

}
