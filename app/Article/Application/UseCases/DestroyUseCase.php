<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;


use App\Article\Infrastructure\Repositories\DestroyRepository;

final readonly class DestroyUseCase
{

    protected DestroyRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repositories\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
