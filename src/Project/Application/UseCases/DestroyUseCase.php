<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\UseCases;

use Aenginus\Project\Application\Repositories\Eloquent\DestroyRepository;
use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

final readonly class DestroyUseCase
{

    private DestroyRepository $repository;


    /**
     * @param \Aenginus\Project\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     */
    public function delete(ProjectEloquentModel $project): void
    {
        $this->repository->delete($project);
    }

}
