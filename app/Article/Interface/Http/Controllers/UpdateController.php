<?php

declare(strict_types=1);

namespace App\Article\Interface\Http\Controllers;

use App\Article\Application\UseCases\UpdateUseCase as ArticleUseCase;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\Entities\ArticleEntity;
use App\Article\Interface\Http\Requests\UpdateRequest;
use App\Core\Laravel\Application\Controller;
use App\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ArticleEloquentModel $article;

    protected ArticleUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     * @param \App\Article\Application\UseCases\UpdateUseCase $bridge
     * @param \App\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(
        ArticleEloquentModel $article,
        ArticleUseCase $bridge,
        MediaUseCase $media
    ) {
        $this->article = $article;
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \App\Article\Interface\Http\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     * @throws \Exception
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $articleEntity = new ArticleEntity($validated);
        $articleInstance = $this->article->find($articleEntity->id);

        $article = $this->bridge->update($articleInstance, $articleEntity);

        if ($request->hasFile('image')) {
            // Attach uploaded signature image.
            $this->media->attach($article, (object) $request['image'], 'signatures');
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'ArticleEloquentModel successfully updated');
    }

}
