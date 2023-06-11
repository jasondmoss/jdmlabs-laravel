<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Project;
use App\Project\Infrastructure\ProjectRepository;
use App\Shared\Interface\EntryFormRequest;

class SaveProjectUseCase {

    protected ProjectRepository $repository;


    /**
     * @param \App\Project\Infrastructure\ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(EntryFormRequest $data): Project
    {
        return $this->repository->save($data);
    }

}
