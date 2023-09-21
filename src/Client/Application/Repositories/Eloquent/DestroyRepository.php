<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Repositories\Eloquent;

use Aenginus\Client\Domain\Contracts\DestroyContract;
use Aenginus\Client\Domain\Models\ClientModel;

final class DestroyRepository implements DestroyContract
{

    /**
     * @inheritDoc
     */
    public function delete(ClientModel $client): void
    {
        $client->delete();
    }

}
