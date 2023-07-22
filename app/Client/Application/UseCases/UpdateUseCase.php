<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Client;
use App\Client\Infrastructure\Repositories\UpdateRepository;
use App\Client\Interface\Requests\Http\UpdateRequest;

class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repositories\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Client\Interface\Requests\Http\UpdateRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function update(UpdateRequest $data): Client
    {
        return $this->repository->update($data);
    }

}
