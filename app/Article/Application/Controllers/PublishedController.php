<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetPublishedArticlesUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller {

    private GetPublishedArticlesUseCase $GetPublished;


    /**
     * @param \App\Article\Application\UseCases\GetPublishedArticlesUseCase $GetPublished
     */
    public function __construct(GetPublishedArticlesUseCase $GetPublished)
    {
        $this->GetPublished = $GetPublished;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $articles = $this->GetPublished->__invoke();

        return ViewFacade::make('ArticlePublic::show', [
            'articles' => $articles
        ]);
    }

}
