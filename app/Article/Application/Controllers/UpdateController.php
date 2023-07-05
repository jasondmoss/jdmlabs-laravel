<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetArticleUseCase;
use App\Article\Application\UseCases\SaveArticleUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;


class UpdateController extends Controller {

    protected GetArticleUseCase $getArticle;

    protected SaveArticleUseCase $updateArticle;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $getArticle
     * @param \App\Article\Application\UseCases\SaveArticleUseCase $updateArticle
     */
    public function __construct(
        GetArticleUseCase $getArticle,
        SaveArticleUseCase $updateArticle
    ) {
        $this->getArticle = $getArticle;
        $this->updateArticle = $updateArticle;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $article = $this->getArticle->__invoke($request->id);
        $this->authorize('owner', $article);

        // Update + return article.
        $this->updateArticle->__invoke($request);

        // Save + attach categories.
//        $article->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $article, 'signatures');

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article successfully updated');
    }

}
