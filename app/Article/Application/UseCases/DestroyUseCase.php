<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
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
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function delete(Article $article): void
    {
        $this->repository->delete($article);
    }

}
