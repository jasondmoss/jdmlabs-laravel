<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Domain\Contract\GetRelatedContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetRelatedProjectsUseCase
{

    private GetRelatedContract $repository;


    /**
     * @param \App\Project\Domain\Contract\GetRelatedContract $repository
     */
    public function __construct(GetRelatedContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(mixed $data): Model|Collection|Builder
    {
        return $this->repository->getRelated($data);
    }

}
