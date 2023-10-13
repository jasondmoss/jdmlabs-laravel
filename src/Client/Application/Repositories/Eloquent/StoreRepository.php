<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Repositories\Eloquent;

use Aenginus\Client\Domain\Contracts\StoreContract;
use Aenginus\Client\Domain\Models\ClientModel;

final class StoreRepository implements StoreContract
{
    /**
     * @inheritDoc
     */
    public function save(object $clientEntity): ClientModel
    {
        return ClientModel::create((array) $clientEntity);
    }
}
