<?php

declare(strict_types=1);

namespace App\Client\Domain\Contract;

use Illuminate\Database\Eloquent\Collection;

interface GetClientProjectsContract
{

    /**
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClientProjects(string $id): Collection;

}
