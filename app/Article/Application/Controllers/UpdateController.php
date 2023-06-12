<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetArticleUseCase;
use App\Article\Application\UseCases\SaveArticleUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;


class UpdateController extends Controller {

    protected GetArticleUseCase $get;

    protected SaveArticleUseCase $update;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $get
     * @param \App\Article\Application\UseCases\SaveArticleUseCase $update
     */
    public function __construct(GetArticleUseCase $get, SaveArticleUseCase $update)
    {
        $this->get = $get;
        $this->update = $update;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $article = $this->get->__invoke($request->id);
        $this->authorize('owner', $article);

        // Update + return article.
//        $article = $this->update->__invoke($request);
        $this->update->__invoke($request);

        // Save + attach categories.
//        $article->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $article, 'signatures');

        return redirect()
            ->route('admin.articles')
            ->with('update', 'The article has been updated successfully.');
    }

}
