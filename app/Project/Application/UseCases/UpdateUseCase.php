<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Application\Repositories\Eloquent\UpdateRepository;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Project\Infrastructure\Entities\ProjectEntity;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Project\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     * @param \App\Project\Infrastructure\Entities\ProjectEntity $entity
     *
     * @return \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel
     */
    public function update(ProjectEloquentModel $project, ProjectEntity $entity): ProjectEloquentModel
    {
        return $this->repository->update($project, $entity);
    }

}
