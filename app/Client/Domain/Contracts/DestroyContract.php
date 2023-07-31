<?php

declare(strict_types=1);

namespace App\Client\Domain\Contracts;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

interface DestroyContract
{

    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function delete(ClientEloquentModel $client): void;

}
