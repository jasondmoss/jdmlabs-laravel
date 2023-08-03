<?php

declare(strict_types=1);

namespace App\Client\Domain\Contracts;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

interface StoreContract
{

    /**
     * @param object $clientEntity
     *
     * @return \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function save(object $clientEntity): ClientEloquentModel;

}
