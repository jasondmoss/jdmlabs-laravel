<?php

declare(strict_types=1);

namespace App\Article\Interface\Web\Controllers;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\ValueObjects\Id;
use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected ArticleEloquentModel $article;


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     */
    public function __construct(ArticleEloquentModel $article)
    {
        $this->article = $article;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(string $id): View
    {
        $article = $this->article->find((new Id($id))->value());

        $article->generateDates();
        $article->generatePermalink();

        $categories = CategoryEloquentModel::get()->pluck('name', 'id');

        $signature = $article->getFirstMedia('signatures');

        return ViewFacade::make('ArticleAdmin::edit', [
            'article' => $article,
            'categories' => $categories,
            'signature' => $signature
        ]);
    }

}
