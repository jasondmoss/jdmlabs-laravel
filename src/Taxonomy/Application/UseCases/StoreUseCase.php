<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\UseCases;

use Aenginus\Taxonomy\Application\Repositories\Eloquent\StoreRepository;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;

final class StoreUseCase
{

    private StoreRepository $repository;


    /**
     * @param \Aenginus\Taxonomy\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $validatedRequest
     *
     * @return \Aenginus\Taxonomy\Domain\Models\CategoryModel
     */
    public function store(object $validatedRequest): CategoryModel
    {
        return $this->repository->save($validatedRequest);
    }

}
