<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\UseCases;

use Aenginus\Project\Application\Repositories\Eloquent\UpdateRepository;
use Aenginus\Project\Domain\Models\ProjectModel;
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
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     * @param \Aenginus\Project\Infrastructure\Entities\ProjectEntity $entity
     *
     * @return \Aenginus\Project\Domain\Models\ProjectModel
     */
    public function update(ProjectModel $project, ProjectEntity $entity): ProjectModel
    {
        return $this->repository->update($project, $entity);
    }

}
