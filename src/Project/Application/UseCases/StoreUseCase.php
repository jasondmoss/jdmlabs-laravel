<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\UseCases;

use Aenginus\Project\Application\Repositories\Eloquent\StoreRepository;
use Aenginus\Project\Domain\Models\ProjectModel;

final readonly class StoreUseCase
{

    private StoreRepository $repository;


    /**
     * @param \Aenginus\Project\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $projectEntity
     *
     * @return \Aenginus\Project\Domain\Models\ProjectModel
     */
    public function store(object $projectEntity): ProjectModel
    {
        return $this->repository->save($projectEntity);
    }

}
