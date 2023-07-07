<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Domain\ProjectRepositoryContract;
use App\Project\Infrastructure\Project;

class GetProjectUseCase
{

    private ProjectRepositoryContract $repository;


    /**
     * @param \App\Project\Domain\ProjectRepositoryContract $repository
     */
    public function __construct(ProjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $key
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function __invoke(string $key): Project
    {
        return $this->repository->get($key);
    }

}
