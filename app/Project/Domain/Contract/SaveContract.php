<?php

declare(strict_types=1);

namespace App\Project\Domain\Contract;

use App\Project\Infrastructure\Project;
use App\Project\Interface\ProjectFormRequest;

interface SaveContract
{

    /**
     * @param \App\Project\Interface\ProjectFormRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function save(ProjectFormRequest $data): Project;

}
