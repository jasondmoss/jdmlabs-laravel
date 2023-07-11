<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repository;

use App\Client\Domain\Contract\GetClientProjectsContract;
use App\Project\Infrastructure\Project;
use Illuminate\Database\Eloquent\Collection;

class GetClientProjectsRepository implements GetClientProjectsContract
{

    /**
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClientProjects(string $id): Collection
    {
        return Project::get()->where('client_id', '=', $id);
    }


}
