<?php

declare(strict_types=1);

namespace App\Client\Domain\Contracts;

use App\Client\Infrastructure\Client;
use App\Client\Interface\Requests\Http\UpdateRequest;

interface UpdateContract
{

    /**
     * @param \App\Client\Interface\Requests\Http\UpdateRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function update(UpdateRequest $data): Client;

}
