<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\UpdateUseCase;
use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\ArticleEntity;
use App\Article\Interface\Http\UpdateRequest;
use App\Core\Laravel\Application\Controller;
use App\Media\Infrastructure\ImageEntity;
use Exception;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;


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
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     * @throws \Exception
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();

        // Create a new validated image entity.
        $articleEntity = new ArticleEntity($validated);

        // Update + return article.
        $article = $this->conjoins->update($articleEntity);

        // Save + attach signature image.
        if ($request->hasFile('image')) {
            try {
                // Delete any existing media attached to this model.
                foreach ($article->media as $media) {
                    $media->delete();
                }

                $imageEntity = new ImageEntity((object) $request->image);

                $article->addMedia($imageEntity->file)
                    ->withCustomProperties([
                        'label' => $imageEntity->label,
                        'alt' => $imageEntity->alt,
                        'caption' => $imageEntity->caption,
                        'width' => $imageEntity->width,
                        'height' => $imageEntity->height
                    ])
                    ->withResponsiveImages()
                    ->toMediaCollection('signatures');
            } catch (FileDoesNotExist|FileIsTooBig $exception) {
                throw new Exception($exception->getMessage());
            }
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article successfully updated');
    }

}
