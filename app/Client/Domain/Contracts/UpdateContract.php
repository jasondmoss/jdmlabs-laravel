<?php

declare(strict_types=1);

namespace App\Client\Domain\Contracts;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Client\Infrastructure\Entities\ClientEntity;

interface UpdateContract
{

    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     * @param \App\Client\Infrastructure\Entities\ClientEntity $entity
     *
     * @return \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function update(
        ClientEloquentModel $client,
        ClientEntity $entity
    ): ClientEloquentModel;

}
