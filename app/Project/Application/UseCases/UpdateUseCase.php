<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Project;
use App\Project\Infrastructure\Repositories\UpdateRepository;
use App\Project\Interface\Requests\Http\UpdateRequest;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Project\Infrastructure\Repositories\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Project\Interface\Requests\Http\UpdateRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function update(UpdateRequest $data): Project
    {
        return $this->repository->update($data);
    }

}
