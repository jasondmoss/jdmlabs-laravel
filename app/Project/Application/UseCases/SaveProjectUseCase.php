<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Project;
use App\Project\Infrastructure\ProjectRepository;
use App\Project\Interface\ProjectFormRequest;

class SaveProjectUseCase
{

    protected ProjectRepository $repository;


    /**
     * @param \App\Project\Infrastructure\ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Project\Interface\ProjectFormRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ProjectFormRequest $data): Project
    {
        return $this->repository->save($data);
    }

}
