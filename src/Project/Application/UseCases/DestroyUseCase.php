<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\UseCases;

use Aenginus\Project\Application\Repositories\Eloquent\DestroyRepository;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Exception;

final readonly class DestroyUseCase
{

    private ProjectModel $project;
    private DestroyRepository $repository;


    /**
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     * @param \Aenginus\Project\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(ProjectModel $project, DestroyRepository $repository)
    {
        $this->project = $project;
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function delete(string $id): void
    {
        $toBeDeleted = $this->project->find((new UlidValueObject($id))->value());

        try {
            $this->repository->delete($toBeDeleted);
        } catch (Exception) {
            throw CouldNotDeleteModelEntity::withId($toBeDeleted->id);
        }
    }

}
