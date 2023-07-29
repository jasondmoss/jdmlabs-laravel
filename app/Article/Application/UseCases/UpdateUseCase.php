<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\Repositories\UpdateRepository;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repositories\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $data
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function update(object $data): Article
    {
        return $this->repository->update($data);
    }

}
