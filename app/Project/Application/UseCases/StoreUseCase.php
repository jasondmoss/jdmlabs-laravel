<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Project;
use App\Project\Infrastructure\Repositories\StoreRepository;
use App\Project\Interface\Requests\Http\CreateRequest;

final readonly class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Project\Infrastructure\Repositories\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Project\Interface\Requests\Http\CreateRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function store(CreateRequest $data): Project
    {
        return $this->repository->save($data);
    }

}
