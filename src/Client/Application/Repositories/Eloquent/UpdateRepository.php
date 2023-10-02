<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Repositories\Eloquent;

use Aenginus\Client\Domain\Contracts\UpdateContract;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;

class UpdateRepository implements UpdateContract
{

    /**
     * @inheritDoc
     */
    final public function update(ClientModel $client, ClientEntity $entity): ClientModel
    {
        $client->update((array)$entity);

        return $client;
    }

}
