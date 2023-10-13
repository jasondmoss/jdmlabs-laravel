<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Contracts;

use Aenginus\Client\Domain\Models\ClientModel;

interface StoreContract
{
    /**
     * @param object $clientEntity
     *
     * @return \Aenginus\Client\Domain\Models\ClientModel
     */
    public function save(object $clientEntity): ClientModel;
}
