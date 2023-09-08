<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Repositories\Eloquent;

use Aenginus\Client\Domain\Contracts\UpdateContract;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;

class UpdateRepository implements UpdateContract
{

    /**
     * @inheritDoc
     */
    final public function update(ClientEloquentModel $client, ClientEntity $entity): ClientEloquentModel
    {
        $client->update((array) $entity);

        return $client;
    }

}
