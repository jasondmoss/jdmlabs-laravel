<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\UseCases;

use Aenginus\Article\Application\Repositories\Eloquent\DestroyRepository;
use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

final readonly class DestroyUseCase
{

    private DestroyRepository $repository;


    /**
     * @param \Aenginus\Article\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function delete(ArticleEloquentModel $article): void
    {
        $this->repository->delete($article);
    }

}
