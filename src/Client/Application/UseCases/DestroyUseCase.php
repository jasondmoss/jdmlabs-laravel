<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\UseCases;

use Aenginus\Client\Application\Repositories\Eloquent\DestroyRepository;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Exception;

final readonly class DestroyUseCase
{

    protected ClientModel $client;
    private DestroyRepository $repository;


    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     * @param \Aenginus\Client\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(ClientModel $client, DestroyRepository $repository)
    {
        $this->client = $client;
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function delete(string $id): void
    {
        $toBeDeleted = $this->client->find((new UlidValueObject($id))->value());

        try {
            $this->repository->delete($toBeDeleted);
        } catch (Exception) {
            throw CouldNotDeleteModelEntity::withId($toBeDeleted->id);
        }
    }

}
