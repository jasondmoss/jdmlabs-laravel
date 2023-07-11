<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repository;

use App\Article\Domain\Contract\SaveContract;
use App\Article\Infrastructure\Article;
use App\Article\Interface\ArticleFormRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class SaveRepository implements SaveContract
{

    private Article $model;


    public function __construct()
    {
        $this->model = new Article;
    }


    /**
     *
     * @param \App\Article\Interface\ArticleFormRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function save(ArticleFormRequest $data): Article
    {
        $article = isset($data->id)
            ? $this->model->find($data->id)
            : (new Article);

        try {
            $article->title = $data->title;
//            $article->slug = Str::slug($data->title);
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

}
