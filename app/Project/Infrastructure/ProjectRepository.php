<?php

declare(strict_types=1);

namespace App\Project\Infrastructure;

use App\Project\Domain\ProjectRepositoryContract;
use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Slug;
use App\Shared\Interface\EntryFormRequest;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection as CollectionSupport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;

class ProjectRepository implements ProjectRepositoryContract {

    private Project $model;


    public function __construct()
    {
        $this->model = new Project();
    }


    /**
     * @param string $key
     *
     * @return \App\Project\Infrastructure\Project
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function get(string $key): Project
    {
        if (! Ulid::isValid($key)) {
            $slug = (new Slug($key))->value();

            return $this->model->firstWhere('slug', $slug);
        }

        $ulid = (new Id($key))->value();

        return $this->model->find($ulid);
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
            ->where('pinned', '=', 'pinned')
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
            ->where('promoted', '=', 'promoted')
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
            ->where('status', '=', 'published')
            ->with('clients')
            ->latest($column)
            ->simplePaginate($pages);
    }


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection
     */
    public function getRelated(mixed $data): Model|Builder|Collection
    {
        /*return $this->model->where('category_id', $data->category_id)
            ->where('status', '=', 1)
            ->where('id', '!=', $data->id)
            ->latest('id')
            ->take(4)
            ->get();*/
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function save(EntryFormRequest $data): Project
    {
        if (is_null($project = $this->model->find($data->id))) {
            $project = new Project;
        }

        try {
            $project->title = $data->title;
            $project->slug = Str::slug($data->title);
            $project->subtitle = $data->subtitle;
            $project->website = $data->website;
            $project->client_id = $data->client_id;
            $project->summary = $data->summary;
            $project->body = $data->body;
            $project->status = $data->status;
            $project->promoted = $data->promoted;
            $project->pinned = $data->pinned;

            $project->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        // Return saved project.
        return Project::findOrFail($project->id);
    }


    /**
     * @param string $id
     *
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function delete(string $id): void
    {
        $objectId = (new Id($id))->value();
        $objectModel = $this->model->find($objectId);

        $objectModel->delete();
    }

}
