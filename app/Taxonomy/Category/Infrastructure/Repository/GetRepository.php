<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure\Repository;

use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Slug;
use App\Taxonomy\Category\Domain\Contract\GetContract;
use App\Taxonomy\Category\Infrastructure\Category;
use Symfony\Component\Uid\Ulid;

class GetRepository implements GetContract
{

    protected Category $model;


    public function __construct()
    {
        $this->model = new Category;
    }


    /**
     * @param string $key
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function get(string $key): Category
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            return $this->model->firstWhere('slug', $slug);
        }

        return $this->model->find((new Id($key))->value());
    }

}
