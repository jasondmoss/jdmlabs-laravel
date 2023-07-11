<?php

declare(strict_types=1);

namespace App\Client\Domain\Contract;

use App\Client\Infrastructure\Client;
use App\Client\Interface\ClientFormRequest;

interface SaveContract
{

    /**
     * @param \App\Client\Interface\ClientFormRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function save(ClientFormRequest $data): Client;

}
