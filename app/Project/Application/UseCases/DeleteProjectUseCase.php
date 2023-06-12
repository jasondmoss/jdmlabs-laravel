<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Domain\ProjectRepositoryContract;

class DeleteProjectUseCase {

    protected ProjectRepositoryContract $repository;


    /**
     * @param \App\Project\Domain\ProjectRepositoryContract $repository
     */
    public function __construct(ProjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     */
    public function __invoke(string $id): void
    {
        $this->repository->delete($id);
    }

}
