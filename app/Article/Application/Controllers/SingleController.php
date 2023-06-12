<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetArticleUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller {

    private GetArticleUseCase $get;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $get
     */
    public function __construct(GetArticleUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $key): View
    {
        $article = $this->get->__invoke($key);
//        $article->categories = $article->categories()->get();

        return ViewFacade::make('ArticlePublic::single', [
            'article' => $article
        ]);
    }

}
