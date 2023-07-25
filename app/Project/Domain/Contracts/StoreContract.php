<?php

declare(strict_types=1);

namespace App\Project\Domain\Contracts;

use App\Project\Infrastructure\Project;
use App\Project\Interface\Http\CreateRequest;

interface StoreContract
{

    /**
     * @param \App\Project\Interface\Http\CreateRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function save(CreateRequest $data): Project;

}
