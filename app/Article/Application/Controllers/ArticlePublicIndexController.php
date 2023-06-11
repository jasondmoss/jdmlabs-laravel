<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetPublishedArticlesUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ArticlePublicIndexController extends Controller {

    private GetPublishedArticlesUseCase $GetPublishedArticles;


    /**
     * @param \App\Article\Application\UseCases\GetPublishedArticlesUseCase $GetPublishedArticles
     */
    public function __construct(GetPublishedArticlesUseCase $GetPublishedArticles)
    {
        $this->GetPublishedArticles = $GetPublishedArticles;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $articles = $this->GetPublishedArticles->__invoke();

        return ViewFacade::make('ArticlePublic::show', [
            'articles' => $articles
        ]);
    }

}
