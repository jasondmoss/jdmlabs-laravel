<?php

declare(strict_types=1);

namespace App\Client\Domain\Contracts;

use App\Client\Infrastructure\Client;

interface DestroyContract
{

    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function delete(Client $client): void;

}
