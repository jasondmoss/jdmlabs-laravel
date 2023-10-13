<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Domain\Models\ClientModel;

interface DestroyContract
{
    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     *
     * @return void
     */
    public function delete(ClientModel $client): void;
}
