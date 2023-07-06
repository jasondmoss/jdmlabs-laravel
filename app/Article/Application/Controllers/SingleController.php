<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetArticleUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private GetArticleUseCase $getArticle;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $getArticle
     */
    public function __construct(GetArticleUseCase $getArticle)
    {
        $this->getArticle = $getArticle;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $key): View
    {
        $article = $this->getArticle->__invoke($key);

        return ViewFacade::make('ArticlePublic::single', [
            'article' => $article
        ]);
    }

}
