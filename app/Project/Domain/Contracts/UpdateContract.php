<?php

declare(strict_types=1);

namespace App\Project\Domain\Contracts;

use App\Project\Infrastructure\Project;
use App\Project\Interface\Requests\Http\UpdateRequest;

interface UpdateContract
{

    /**
     * @param \App\Project\Interface\Requests\Http\UpdateRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function update(UpdateRequest $data): Project;

}
