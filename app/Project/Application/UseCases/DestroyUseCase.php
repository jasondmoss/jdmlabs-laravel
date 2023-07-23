<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Project;
use App\Project\Infrastructure\Repositories\DestroyRepository;

final readonly class DestroyUseCase
{

    protected DestroyRepository $repository;


    /**
     * @param \App\Project\Infrastructure\Repositories\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Project\Infrastructure\Project $project
     */
    public function delete(Project $project): void
    {
        $this->repository->delete($project);
    }

}
