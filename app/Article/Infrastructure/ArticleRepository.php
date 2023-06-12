<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use App\Article\Domain\ArticleRepositoryContract;
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
use Str;
use Symfony\Component\Uid\Ulid;

class ArticleRepository implements ArticleRepositoryContract {

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

        $ulid = (new Id($key))->value();

        return $this->model->find($ulid);
    }


    /**
     * @param bool $pluck
     * @param string|null $column
     * @param int|null $key
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getAll(
        bool $pluck = false,
        ?string $column = null,
        ?int $key = null
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
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function save(EntryFormRequest $data): Article
    {
        $article = isset($data->id)
            ? $this->model->find($data->id)
            : (new Article);

        try {
            $article->title = $data->title;
            $article->slug = Str::slug($data->title);
            $article->summary = $data->summary;
            $article->body = $data->body;
            $article->status = $data->status;
            $article->promoted = $data->promoted;

            $article->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        // Return saved article.
        return Article::findOrFail($article->id);
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function delete(string $id): void
    {
        $modelId = (new Id($id))->value();
        $objectModel = $this->model->find($modelId);

        $objectModel->delete();
    }

}
