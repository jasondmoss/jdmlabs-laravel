<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\UpdateUseCase as ArticleUseCase;
use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\Entities\ArticleEntity;
use App\Article\Interface\Http\UpdateRequest;
use App\Core\Laravel\Application\Controller;
use App\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use Illuminate\Http\RedirectResponse;


class UpdateController extends Controller
{

    protected Article $article;

    protected ArticleUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \App\Article\Infrastructure\Article $article
     * @param \App\Article\Application\UseCases\UpdateUseCase $bridge
     * @param \App\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(Article $article, ArticleUseCase $bridge, MediaUseCase $media)
    {
        $this->article = $article;
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \App\Article\Interface\Http\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();

        // Create a new validated image entity.
        $articleEntity = new ArticleEntity($validated);

        // Update + return article.
        $article = $this->bridge->update($articleEntity);

        if ($request->hasFile('image')) {
            // Attach uploaded signature image.
            $this->media->attach($article, (object) $request->image, 'signatures');
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article successfully updated');
    }

}
