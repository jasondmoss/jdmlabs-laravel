<?php

declare(strict_types=1);

namespace App\Client\Domain\Contracts;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

interface StoreContract
{

    /**
     * @param object $data
     *
     * @return \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function save(object $data): ClientEloquentModel;

}
