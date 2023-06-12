<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Slug;
use App\Shared\Interface\EntryFormRequest;
use App\Taxonomy\Domain\TaxonomyRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionSupport;

class TaxonomyRepository implements TaxonomyRepositoryContract {

    private Vocabulary $model;


    public function __construct()
    {
        $this->model = new Vocabulary();
    }


    /**
     * @param int|string $key
     *
     * @return \App\Taxonomy\Infrastructure\Vocabulary
     */
    public function get(int|string $key): Vocabulary
    {
        if (! is_int($key)) {
            $slug = (new Slug($key))->value();

            return $this->model->firstWhere('slug', $slug);
        }

        $id = (new Id($key))->value();

        return $this->model->find($id);
    }


    /**
     * @param bool $pluck
     * @param string|null $column
     * @param mixed|null $key
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getAll(
        bool $pluck = false,
        string $column = null,
        mixed $key = null
    ): Collection|CollectionSupport
    {
        // TODO: Implement getAll() method.
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $data
     *
     * @return \App\Taxonomy\Infrastructure\Vocabulary
     */
    public function save(EntryFormRequest $data): Vocabulary
    {
        // TODO: Implement save() method.
    }


    /**
     * @param int|string $id
     *
     * @return void
     */
    public function delete(int|string $id): void
    {
        // TODO: Implement delete() method.
    }

}
