<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetArticleUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ArticleAdminEditController extends Controller {

    protected GetArticleUseCase $get;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $get
     */
    public function __construct(GetArticleUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $article = $this->get->__invoke((new Id($id))->value());
        $this->authorize('owner', $article);

//        $article->signature = $article->getMedia('signatures')->first();

        return ViewFacade::make('ArticleAdmin::edit', [
            'article' => $article
        ]);
    }

}
