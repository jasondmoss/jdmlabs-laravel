<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\UpdateUseCase as ArticleUseCase;
use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\UpdateRequest;
use Aenginus\Media\Application\UseCases\StoreImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    protected ArticleModel $article;

    protected ArticleUseCase $articleUseCase;

    protected StoreImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     * @param \Aenginus\Article\Application\UseCases\UpdateUseCase $articleUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreImageUseCase $imageUseCase
     */
    public function __construct(
        ArticleModel $article,
        ArticleUseCase $articleUseCase,
        StoreImageUseCase $imageUseCase
    ) {
        $this->article = $article;
        $this->articleUseCase = $articleUseCase;
        $this->imageUseCase = $imageUseCase;
    }


    /**
     * @param \Aenginus\Article\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     * @throws \ReflectionException
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $articleEntity = new ArticleEntity($validated);
        $articleInstance = $this->article->find($articleEntity->id);
        $article = $this->articleUseCase->update($articleInstance, $articleEntity);

        $requestImages = [];

        // Signature image.
        if ($request->file('signature_image') !== null) {
            foreach ($request->signature_image as $signature_image) {
                $requestImages[] = (object) $signature_image;
            }
        }

        $this->imageUseCase->store($article, $requestImages);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article updated successfully.');
    }
}
