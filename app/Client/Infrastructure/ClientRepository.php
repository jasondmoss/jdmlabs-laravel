<?php

declare(strict_types=1);

namespace App\Client\Infrastructure;

use App\Client\Domain\ClientRepositoryContract;
use App\Client\Interface\ClientFormRequest;
use App\Project\Infrastructure\Project;
use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Slug;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection as CollectionSupport;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Uid\Ulid;

class ClientRepository implements ClientRepositoryContract
{

    private Client $model;


    public function __construct()
    {
        $this->model = new Client;
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
        if (! $pluck) {
            return $this->model->all();
        }

        return $this->model->pluck($column, $key);
    }


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPinned(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->model
            ->where('pinned', 'pinned')
            ->latest($column)
            ->simplePaginate($pages);
    }


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPromoted(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->model
            ->where('promoted', 'promoted')
            ->latest($column)
            ->simplePaginate($pages);
    }


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPublished(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->model
            ->where('status', 'published')
            ->latest($column)
            ->simplePaginate($pages);
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getClientProjects(string $id): Collection
    {
        return Project::get()->where('client_id', '=', $id);
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

        $ulid = (new Id($key))->value();

        return $this->model->find($ulid);
    }


    /**
     * @param \App\Client\Interface\ClientFormRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function save(ClientFormRequest $data): Client
    {
        $client = isset($data->id)
            ? $this->model->find($data->id)
            : (new Client);

        try {
            $client->name = $data->name;
            $client->slug = $data->slug;
            $client->itemprop = $data->itemprop;
            $client->website = $data->website;
            $client->summary = $data->summary;
            $client->status = $data->status;
            $client->promoted = $data->promoted;

            $client->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        // Return saved client.
        return Client::findOrFail($client->id);
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
