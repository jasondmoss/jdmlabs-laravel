<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

interface StoreContract
{

    /**
     * @param object $clientEntity
     *
     * @return \Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function save(object $clientEntity): ClientEloquentModel;

}
