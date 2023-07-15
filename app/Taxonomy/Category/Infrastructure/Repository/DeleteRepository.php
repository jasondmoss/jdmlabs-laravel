<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure\Repository;

use App\Shared\ValueObjects\Id;
use App\Taxonomy\Category\Domain\Contract\DeleteContract;
use App\Taxonomy\Category\Infrastructure\Category;

class DeleteRepository implements DeleteContract
{

    protected Category $model;


    public function __construct()
    {
        $this->model = new Category;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Shared\Exceptions\CouldNotFindCategory
     */
    public function delete(string $id): void
    {
        $objectModel = $this->model->find((new Id($id))->value());

        $objectModel->delete();
    }

}
