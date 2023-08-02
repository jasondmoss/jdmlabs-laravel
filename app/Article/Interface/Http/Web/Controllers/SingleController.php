<?php

declare(strict_types=1);

namespace App\Article\Interface\Http\Web\Controllers;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Core\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private ArticleEloquentModel $article;


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     */
    public function __construct(ArticleEloquentModel $article)
    {
        $this->article = $article;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(string $key): View
    {
        $article = $this->article->find($key);

        $signature = $article->getFirstMedia('signatures');

        return ViewFacade::make('ArticlePublic::single', [
            'article' => $article,
            'signature' => $signature
        ]);
    }

}
