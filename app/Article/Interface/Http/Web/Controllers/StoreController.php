<?php

declare(strict_types=1);

namespace App\Article\Interface\Http\Web\Controllers;

use App\Article\Application\UseCases\StoreUseCase;
use App\Article\Infrastructure\Entities\ArticleEntity;
use App\Article\Interface\Http\Web\Requests\CreateRequest;
use App\Core\Laravel\Application\Controller;
use App\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use App\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \App\Article\Application\UseCases\StoreUseCase $bridge
     * @param \App\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(StoreUseCase $bridge, MediaUseCase $media)
    {
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \App\Article\Interface\Http\Web\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $articleEntity = new ArticleEntity($validated);

        $article = $this->bridge->store($articleEntity);

        if ($request->hasFile('signature_image')) {
            $imageEntity = new ImageEntity((object) $request->signature_image);

            // Attach uploaded signature image.
            $this->media->attach($article, $imageEntity, 'signatures');
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Article created successfully.');
    }

}
