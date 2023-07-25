<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\UpdateUseCase;
use App\Article\Infrastructure\Article;
use App\Article\Interface\Http\UpdateRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;


class UpdateController extends Controller
{

    protected Article $article;

    protected UpdateUseCase $conjoins;


    /**
     * @param \App\Article\Infrastructure\Article $article
     * @param \App\Article\Application\UseCases\UpdateUseCase $conjoins
     */
    public function __construct(Article $article, UpdateUseCase $conjoins)
    {
        $this->article = $article;
        $this->conjoins = $conjoins;
    }


    /**
     * @param \App\Article\Interface\Http\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        // Update + return article.
        $article = $this->conjoins->update($request);

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $article, 'signatures');

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article successfully updated');
    }

}
