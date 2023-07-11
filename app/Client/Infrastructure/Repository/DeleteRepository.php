<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repository;

use App\Client\Domain\Contract\DeleteContract;
use App\Client\Infrastructure\Client;
use App\Shared\Domain\ValueObjects\Id;

class DeleteRepository implements DeleteContract
{

    private Client $model;


    public function __construct()
    {
        $this->model = new Client;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function delete(string $id): void
    {
        $objectModel = $this->model->find((new Id($id))->value());

        $objectModel->delete();
    }

}
