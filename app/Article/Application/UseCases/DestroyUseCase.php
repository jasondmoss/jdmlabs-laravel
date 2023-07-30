<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Application\Repositories\Eloquent\DestroyRepository;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

final readonly class DestroyUseCase
{

    protected DestroyRepository $repository;


    /**
     * @param \App\Article\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function delete(ArticleEloquentModel $article): void
    {
        $this->repository->delete($article);
    }

}
