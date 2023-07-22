<?php

declare(strict_types=1);

namespace App\Client\Domain\Contracts;

use App\Client\Infrastructure\Client;
use App\Client\Interface\Requests\Http\CreateRequest;

interface StoreContract
{

    /**
     * @param \App\Client\Interface\Requests\Http\CreateRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function save(CreateRequest $data): Client;

}
