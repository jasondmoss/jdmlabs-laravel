<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

interface DestroyContract
{

    /**
     * @param \Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function delete(ClientEloquentModel $client): void;

}
