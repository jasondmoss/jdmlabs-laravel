<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Repositories\Eloquent;

use Aenginus\Client\Domain\Contracts\StoreContract;
use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(object $clientEntity): ClientEloquentModel
    {
        return ClientEloquentModel::create((array) $clientEntity);
    }

}
