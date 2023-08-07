<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return void
     */
    public function delete(ClientEloquentModel $client): void;

}
