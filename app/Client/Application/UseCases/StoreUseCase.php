<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Client;
use App\Client\Infrastructure\Repositories\StoreRepository;
use App\Client\Interface\Requests\Http\CreateRequest;

final readonly class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repositories\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Client\Interface\Requests\Http\CreateRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function store(CreateRequest $data): Client
    {
        return $this->repository->save($data);
    }

}
