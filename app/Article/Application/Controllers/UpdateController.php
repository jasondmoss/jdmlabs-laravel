<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetArticleUseCase;
use App\Article\Application\UseCases\SaveArticleUseCase;
use App\Article\Interface\ArticleFormRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;


class UpdateController extends Controller
{

    protected GetArticleUseCase $getArticle;

    protected SaveArticleUseCase $updateArticle;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $getArticle
     * @param \App\Article\Application\UseCases\SaveArticleUseCase $updateArticle
     */
    public function __construct(
        GetArticleUseCase $getArticle,
        SaveArticleUseCase $updateArticle
    )
    {
        $this->getArticle = $getArticle;
        $this->updateArticle = $updateArticle;
    }


    /**
     * @param \App\Article\Interface\ArticleFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ArticleFormRequest $request): RedirectResponse
    {
        if (! empty($request->id)) {
            $article = $this->getArticle->__invoke($request->id);

            $this->authorize('owner', $article);
        }

        // Update + return article.
        $article = $this->updateArticle->__invoke($request);

        // Save + attach categories.
        //        $article->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
        //        $this->saveImage->__invoke($request->image, $article, 'signatures');

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article successfully updated');
    }

}
