<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\ProjectRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetRelatedProjectsUseCase {

    private ProjectRepository $repository;


    public function __construct()
    {
        $this->repository = new ProjectRepository;
    }


    public function __invoke(mixed $data): Model|Collection|Builder
    {
        return $this->repository->getRelatedProjects($data);
    }

}
