<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Project;
use App\Project\Infrastructure\Repository\GetRepository;

class GetProjectUseCase
{

    private GetRepository $repository;


    /**
     * @param \App\Project\Infrastructure\Repository\GetRepository $repository
     */
    public function __construct(GetRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $key
     *
     * @return \App\Project\Infrastructure\Project
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $key): Project
    {
        return $this->repository->get($key);
    }

}
