<?php

declare(strict_types=1);

namespace App\Client\Domain\Contract;

use App\Client\Infrastructure\Client;

interface GetContract
{

    /**
     * @param string $key
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function get(string $key): Client;

}
