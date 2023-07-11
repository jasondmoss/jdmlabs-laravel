<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repository;

use App\Article\Domain\Contract\DeleteContract;
use App\Article\Infrastructure\Article;
use App\Shared\Domain\ValueObjects\Id;

final class DeleteRepository implements DeleteContract
{

    private Article $model;


    public function __construct()
    {
        $this->model = new Article;
    }


    /**
     * @param string $id
     *
     * @return void
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
