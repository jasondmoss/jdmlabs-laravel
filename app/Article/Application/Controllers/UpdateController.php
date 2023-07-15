<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\StoreArticleUseCase;
use App\Article\Infrastructure\Article;
use App\Article\Interface\ArticleFormRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;


class UpdateController extends Controller
{

    protected Article $article;

    protected StoreArticleUseCase $updateArticle;


    /**
     * @param \App\Article\Infrastructure\Article $article
     * @param \App\Article\Application\UseCases\StoreArticleUseCase $updateArticle
     */
    public function __construct(Article $article, StoreArticleUseCase $updateArticle)
    {
        $this->article = $article;
        $this->updateArticle = $updateArticle;
    }


    /**
     * @param \App\Article\Interface\ArticleFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(ArticleFormRequest $request): RedirectResponse
    {
        if (! empty($request->id)) {
            $article = $this->article->find($request->id);

            $this->authorize('owner', $article);
        }

        // Update + return article.
        $article = $this->updateArticle->__invoke($request);

        // Save + attach categories.
//        $article->category()->associate($request->get('category'));

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $article, 'signatures');

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article successfully updated');
    }

}
