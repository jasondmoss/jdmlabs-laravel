<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Repositories\Eloquent;

use Aenginus\Client\Domain\Contracts\DestroyContract;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(ClientEloquentModel $client): void
    {
        $client->delete();
    }

}
