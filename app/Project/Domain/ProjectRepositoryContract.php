<?php

declare(strict_types=1);

namespace App\Project\Domain;

use App\Project\Infrastructure\Project;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection as CollectionSupport;

interface ProjectRepositoryContract {

    /**
     * @param string $key
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function getProject(string $key): Project;


    /**
     * @param bool $pluck
     * @param string|null $column
     * @param mixed|null $key
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getAllProjects(
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
    public function getPinnedProjects(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPromotedProjects(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPublishedProjects(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedProjects(mixed $data): Model|Builder|Collection;


    /**
     * @param \App\Shared\Interface\EntryFormRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     */
    public function save(EntryFormRequest $data): Project;


    /**
     * @param string $id
     *
     * @return void
     */
    public function deleteProject(string $id): void;

}
