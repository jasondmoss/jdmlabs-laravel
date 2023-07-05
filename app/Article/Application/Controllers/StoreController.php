<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\SaveArticleUseCase;
use App\Article\Infrastructure\Article;
use App\Laravel\Application\Controller;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;


class StoreController extends Controller {

    protected SaveArticleUseCase $saveArticle;


    /**
     * @param \App\Article\Application\UseCases\SaveArticleUseCase $saveArticle
     */
    public function __construct(SaveArticleUseCase $saveArticle)
    {
        $this->saveArticle = $saveArticle;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $this->authorize('create', Article::class);

        // Store + return article.
        $article = $this->saveArticle->__invoke($request);

        // Save + attach categories.
//        $article->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveSignature->__invoke($request->image, $article, 'signatures');

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'The article has been successfully saved.');
    }

}
