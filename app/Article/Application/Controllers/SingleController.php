<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Infrastructure\Article;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private Article $article;


    /**
     * @param \App\Article\Infrastructure\Article $article
     */
    public function __construct(Article $article)
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

        return ViewFacade::make('ArticlePublic::single', [
            'article' => $article
        ]);
    }

}
