<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;

interface StoreContract
{

    /**
     * @param object $clientEntity
     *
     * @return \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel
     */
    public function save(object $clientEntity): ClientEloquentModel;

}
