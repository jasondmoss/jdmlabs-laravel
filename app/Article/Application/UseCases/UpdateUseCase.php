<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\Repositories\UpdateRepository;
use App\Article\Interface\Http\UpdateRequest;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repositories\UpdateRepository $respository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Article\Interface\Http\UpdateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function update(UpdateRequest $data): Article
    {
        return $this->repository->update($data);
    }

}
