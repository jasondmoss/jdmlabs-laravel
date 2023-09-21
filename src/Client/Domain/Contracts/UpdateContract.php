<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;

interface UpdateContract
{

    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     * @param \Aenginus\Client\Infrastructure\Entities\ClientEntity $entity
     *
     * @return \Aenginus\Client\Domain\Models\ClientModel
     */
    public function update(ClientModel $client, ClientEntity $entity): ClientModel;

}
