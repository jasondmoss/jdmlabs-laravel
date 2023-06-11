<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\ProjectRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionSupport;

final class GetAllProjectsUseCase {

    private ProjectRepository $repository;


    /**
     * @param \App\Project\Infrastructure\ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param bool $pluck
     * @param string|null $column
     * @param mixed|null $key
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke(
        bool $pluck = false,
        string $column = null,
        mixed $key = null
    ): Collection|CollectionSupport
    {
        return $this->repository->getAllProjects($pluck, $column, $key);
    }

}
