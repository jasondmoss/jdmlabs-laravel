<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Repositories\GetRelatedRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class GetRelatedArticlesUseCase
{

    private GetRelatedRepository $repository;


    public function __construct()
    {
        $this->repository = new GetRelatedRepository;
    }


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(mixed $data): Model|Collection|Builder
    {
        return $this->repository->getRelated($data);
    }

}
