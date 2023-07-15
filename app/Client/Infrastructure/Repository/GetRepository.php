<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repository;

use App\Client\Infrastructure\Client;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Slug;
use Symfony\Component\Uid\Ulid;

class GetRepository implements \App\Client\Domain\Contract\GetContract
{

    private Client $model;


    public function __construct()
    {
        $this->model = new Client;
    }


    /**
     * @param string $key
     *
     * @return \App\Client\Infrastructure\Client
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function get(string $key): Client
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            return $this->model->firstWhere('slug', $slug);
        }

        return $this->model->find((new Id($key))->value());
    }

}
