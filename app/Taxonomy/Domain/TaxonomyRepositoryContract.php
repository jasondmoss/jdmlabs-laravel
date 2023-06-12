<?php

declare(strict_types=1);

namespace App\Taxonomy\Domain;

use App\Shared\Interface\EntryFormRequest;
use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as CollectionSupport;

interface TaxonomyRepositoryContract {


    public function get(int|string $key): Vocabulary;


    public function getAll(
        bool $pluck = false,
        string $column = null,
        mixed $key = null
    ): Collection|CollectionSupport;


    public function save(EntryFormRequest $data): Vocabulary;


    public function delete(int|string $id): void;

}
