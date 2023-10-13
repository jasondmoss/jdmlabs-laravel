<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\StoreUseCase as ArticleStoreUseCase;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\StoreImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    protected ArticleStoreUseCase $articleUseCase;

    protected StoreImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Article\Application\UseCases\StoreUseCase $articleUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreImageUseCase $imageUseCase
     */
    public function __construct(
        ArticleStoreUseCase $articleUseCase,
        StoreImageUseCase $imageUseCase
    ) {
        $this->articleUseCase = $articleUseCase;
        $this->imageUseCase = $imageUseCase;
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
        $article = $this->articleUseCase->store($articleEntity);

        $requestImages = [];

        // Signature image.
        if ($request->file('signature_image') !== null) {
            foreach ($request->signature_image as $signature_image) {
                $requestImages[] = (object) $signature_image;
            }
        }

        $this->imageUseCase->store($article, $requestImages);

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Article created successfully.');
    }
}
