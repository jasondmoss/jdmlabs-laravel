<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\UseCases;

use Aenginus\Client\Application\Repositories\Eloquent\UpdateRepository;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;

final readonly class UpdateUseCase
{

    private UpdateRepository $repository;


    /**
     * @param \Aenginus\Client\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     * @param \Aenginus\Client\Infrastructure\Entities\ClientEntity $entity
     *
     * @return \Aenginus\Client\Domain\Models\ClientModel
     */
    public function update(ClientModel $client, ClientEntity $entity): ClientModel
    {
        return $this->repository->update($client, $entity);
    }

}
