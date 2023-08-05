<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\StoreUseCase;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \Aenginus\Article\Application\UseCases\StoreUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(StoreUseCase $bridge, MediaUseCase $media)
    {
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \Aenginus\Article\Interface\Web\Requests\CreateRequest $request
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
