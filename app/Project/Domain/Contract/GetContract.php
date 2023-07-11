<?php

declare(strict_types=1);

namespace App\Project\Domain\Contract;

use App\Project\Infrastructure\Project;

interface GetContract
{

    /**
     * @param string $key
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function get(string $key): Project;

}
