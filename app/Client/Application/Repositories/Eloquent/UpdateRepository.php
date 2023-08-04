<?php

declare(strict_types=1);

namespace App\Client\Application\Repositories\Eloquent;

use App\Client\Domain\Contracts\UpdateContract;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Client\Infrastructure\Entities\ClientEntity;

class UpdateRepository implements UpdateContract
{

    protected ClientEloquentModel $client;


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     */
    public function __construct(ClientEloquentModel $client)
    {
        $this->client = $client;
    }


    /**
     * @inheritDoc
     */
    public function update(ClientEloquentModel $client, ClientEntity $entity): ClientEloquentModel
    {
        $client->update((array) $entity);

        return $client;
    }

}
