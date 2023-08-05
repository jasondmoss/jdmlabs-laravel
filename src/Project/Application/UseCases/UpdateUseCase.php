<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\UseCases;

use Aenginus\Project\Application\Repositories\Eloquent\UpdateRepository;
use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;

final readonly class UpdateUseCase
{

    private UpdateRepository $repository;


    /**
     * @param \Aenginus\Project\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     * @param \Aenginus\Project\Infrastructure\Entities\ProjectEntity $entity
     *
     * @return \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel
     */
    public function update(ProjectEloquentModel $project, ProjectEntity $entity): ProjectEloquentModel
    {
        return $this->repository->update($project, $entity);
    }

}
