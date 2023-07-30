<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Application\Repositories\Eloquent\DestroyRepository;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

final readonly class DestroyUseCase
{

    protected DestroyRepository $repository;


    /**
     * @param \App\Project\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     */
    public function delete(ProjectEloquentModel $project): void
    {
        $this->repository->delete($project);
    }

}
