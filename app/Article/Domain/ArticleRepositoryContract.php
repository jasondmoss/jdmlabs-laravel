<?php

declare(strict_types=1);

namespace App\Article\Domain;

use App\Article\Infrastructure\Article;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection as CollectionSupport;

interface ArticleRepositoryContract {

    /**
     * @param string $key
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function getArticle(string $key): Article;


    /**
     * @param bool $pluck
     * @param string|null $column
     * @param int|null $key
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getAllArticles(
        bool $pluck = false,
        ?string $column = null,
        ?int $key = null
    ): Collection|CollectionSupport;


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPromotedArticles(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getPublishedArticles(string $column = 'id', int $pages = 10): Paginator|Builder;


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedArticles(mixed $data): Model|Builder|Collection;


    /**
     * @param \App\Shared\Interface\EntryFormRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function save(EntryFormRequest $data): Article;


    /**
     * @param string $id
     *
     * @return void
     */
    public function deleteArticle(string $id): void;

}
