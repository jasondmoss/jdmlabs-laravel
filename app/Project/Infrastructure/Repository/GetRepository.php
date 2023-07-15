<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repository;

use App\Project\Domain\Contract\GetContract;
use App\Project\Infrastructure\Project;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Slug;
use Symfony\Component\Uid\Ulid;

class GetRepository implements GetContract
{

    private Project $model;


    public function __construct()
    {
        $this->model = new Project;
    }


    /**
     * @param string $key
     *
     * @return \App\Project\Infrastructure\Project
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function get(string $key): Project
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            return $this->model->firstWhere('slug', $slug);
        }

        return $this->model->find((new Id($key))->value());
    }

}
