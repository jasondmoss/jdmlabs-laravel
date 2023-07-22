<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repositories;

use App\Client\Domain\Contracts\DestroyContract;
use App\Client\Infrastructure\Client;

class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(Client $client): void
    {
        $client->delete();
    }

}
