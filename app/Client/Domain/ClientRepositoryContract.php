<?php

declare(strict_types=1);

namespace App\Client\Domain;

use App\Client\Infrastructure\Client;
use App\Client\Interface\ClientFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection as CollectionSupport;

interface ClientRepositoryContract
{

    /**
     * @param string $key
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function get(string $key): Client;


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
    ): Collection|CollectionSupport;


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPinned(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPromoted(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPublished(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClientProjects(string $id): Collection;


    /**
     * @param \App\Client\Interface\ClientFormRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function save(ClientFormRequest $data): Client;


    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void;

}
