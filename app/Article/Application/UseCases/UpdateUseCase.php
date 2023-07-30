<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Application\Repositories\Eloquent\UpdateRepository;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\Entities\ArticleEntity;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Article\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     * @param \App\Article\Infrastructure\Entities\ArticleEntity $entity
     *
     * @return \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function update(ArticleEloquentModel $article, ArticleEntity $entity): ArticleEloquentModel
    {
        return $this->repository->update($article, $entity);
    }

}
