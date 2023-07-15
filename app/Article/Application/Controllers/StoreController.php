<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\StoreArticleUseCase;
use App\Article\Infrastructure\Article;
use App\Article\Interface\ArticleFormRequest;
use App\Article\Interface\Requests\Http\CreateRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;


class StoreController extends Controller
{

    protected StoreArticleUseCase $saveArticle;


    /**
     * @param \App\Article\Application\UseCases\StoreArticleUseCase $saveArticle
     */
    public function __construct(StoreArticleUseCase $saveArticle)
    {
        $this->saveArticle = $saveArticle;
    }


    /**
     * @param \App\Article\Interface\Requests\Http\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        // Store + return article.
        $article = $this->saveArticle->__invoke($request);

        // Save + attach categories.
//        $article->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveSignature->__invoke($request->image, $article, 'signatures');

        return redirect()->action(IndexController::class);
    }

}
