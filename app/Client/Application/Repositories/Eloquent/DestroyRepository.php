<?php

declare(strict_types=1);

namespace App\Client\Application\Repositories\Eloquent;

use App\Client\Domain\Contracts\DestroyContract;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(ClientEloquentModel $client): void
    {
        $client->delete();
    }

}
