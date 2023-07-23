<?php

declare(strict_types=1);

namespace App\Project\Domain\Contracts;

use App\Project\Infrastructure\Project;

interface DestroyContract
{

    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return void
     */
    public function delete(Project $project): void;

}
