<?php

declare(strict_types=1);

namespace App\Media\Application\UseCases;

use App\Media\Infrastructure\Repositories\AttachRepository;

final readonly class AttachUseCase
{

    protected AttachRepository $repository;


    /**
     * @param \App\Media\Infrastructure\Repositories\AttachRepository $repository
     */
    public function __construct(AttachRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param $model
     * @param $data
     * @param $collection
     *
     * @throws \Exception
     */
    public function attach($model, $data, $collection): void
    {
        $this->repository->attach($model, $data, $collection);
    }

}
