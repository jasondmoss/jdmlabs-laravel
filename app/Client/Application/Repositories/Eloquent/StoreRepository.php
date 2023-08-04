<?php

declare(strict_types=1);

namespace App\Client\Application\Repositories\Eloquent;

use App\Client\Domain\Contracts\StoreContract;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(object $clientEntity): ClientEloquentModel
    {
        return ClientEloquentModel::create((array) $clientEntity);
    }

}
