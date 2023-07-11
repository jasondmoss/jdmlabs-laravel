<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\SaveArticleUseCase;
use App\Article\Infrastructure\Article;
use App\Article\Interface\ArticleFormRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;


class StoreController extends Controller
{

    protected SaveArticleUseCase $saveArticle;


    /**
     * @param \App\Article\Application\UseCases\SaveArticleUseCase $saveArticle
     */
    public function __construct(SaveArticleUseCase $saveArticle)
    {
        $this->saveArticle = $saveArticle;
    }


    /**
     * @param \App\Article\Interface\ArticleFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ArticleFormRequest $request): RedirectResponse
    {
//        $this->authorize('create', Article::class);

        // Store + return article.
        $article = $this->saveArticle->__invoke($request);
        dd($article);

        // Save + attach categories.
//        $article->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveSignature->__invoke($request->image, $article, 'signatures');

//        return redirect()->action(IndexController::class);
    }

}
