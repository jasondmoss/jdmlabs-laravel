<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     * @param \Aenginus\Client\Infrastructure\Entities\ClientEntity $entity
     *
     * @return \Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function update(
        ClientEloquentModel $client,
        ClientEntity $entity
    ): ClientEloquentModel;

}
