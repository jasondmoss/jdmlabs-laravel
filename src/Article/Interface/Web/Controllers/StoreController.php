<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\StoreUseCase as ArticleStoreUseCase;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\StoreSingleImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected ArticleStoreUseCase $articleUseCase;

    protected StoreSingleImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Article\Application\UseCases\StoreUseCase $articleUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreSingleImageUseCase $imageUseCase
     */
    public function __construct(
        ArticleStoreUseCase $articleUseCase,
        StoreSingleImageUseCase $imageUseCase
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
        $validated = (object)$request->validated();

        $articleEntity = new ArticleEntity($validated);

        $article = $this->articleUseCase->store($articleEntity);

        // Signature image (single).
        if ($request->hasFile('signature_image')) {
            $this->imageUseCase->store($article, (object) $request->signature_image);
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Article created successfully.');
    }

}
