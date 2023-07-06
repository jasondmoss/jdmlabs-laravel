<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\ProjectRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetRelatedProjectsUseCase
{

    private ProjectRepository $repository;


    public function __construct()
    {
        $this->repository = new ProjectRepository;
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
