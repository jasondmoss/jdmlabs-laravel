<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repository;

use App\Article\Domain\Contract\GetContract;
use App\Article\Infrastructure\Article;
use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Slug;
use Symfony\Component\Uid\Ulid;

final class GetRepository implements GetContract
{

    private Article $model;


    public function __construct()
    {
        $this->model = new Article;
    }


    /**
     * @param string $key
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function get(string $key): Article
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            return $this->model->firstWhere('slug', $slug);
        }

        return $this->model->find((new Id($key))->value());
    }

}
