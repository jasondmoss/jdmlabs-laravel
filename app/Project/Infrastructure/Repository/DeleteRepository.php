<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repository;

use App\Project\Domain\Contract\DeleteContract;
use App\Project\Infrastructure\Project;
use App\Shared\ValueObjects\Id;

class DeleteRepository implements DeleteContract
{

    private Project $model;


    public function __construct()
    {
        $this->model = new Project;
    }


    /**
     * @param string $id
     *
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function delete(string $id): void
    {
        $objectModel = $this->model->find(
            (new Id($id))->value()
        );

        $objectModel->delete();
    }

}
