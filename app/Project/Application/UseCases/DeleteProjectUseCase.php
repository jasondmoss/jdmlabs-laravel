<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;


use App\Project\Infrastructure\Repository\DeleteRepository;

class DeleteProjectUseCase
{

    protected DeleteRepository $repository;


    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $id): void
    {
        $this->repository->delete($id);
    }

}
