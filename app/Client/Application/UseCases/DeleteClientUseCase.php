<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Repository\DeleteRepository;

class DeleteClientUseCase
{

    protected DeleteRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repository\DeleteRepository $repository
     */
    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $id): void
    {
        $this->repository->delete($id);
    }

}
