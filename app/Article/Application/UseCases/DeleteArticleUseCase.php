<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;


use App\Article\Infrastructure\Repositories\DeleteRepository;

final class DeleteArticleUseCase
{

    protected DeleteRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repositories\DeleteRepository $repository
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
