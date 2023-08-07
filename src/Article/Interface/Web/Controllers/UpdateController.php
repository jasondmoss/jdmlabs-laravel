<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\UpdateUseCase as ArticleUseCase;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\UpdateRequest;
use Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase as MediaUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use App\Controller;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class UpdateController extends Controller
{

    protected ArticleEloquentModel $article;

    protected ArticleUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     * @param \Aenginus\Article\Application\UseCases\UpdateUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase $media
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
     * @param \Aenginus\Article\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Article\Application\Exceptions\CouldNotFindArticle
     * @throws \Exception
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $articleEntity = new ArticleEntity($validated);

        $articleInstance = $this->article->find($articleEntity->id);

        $article = $this->bridge->update($articleInstance, $articleEntity);

        if ($request->hasFile('signature_image')) {
            $signatureImage = $request->file('signature_image');

            if ($signatureImage['file']->isValid()) {
                $imageEntity = new ImageEntity((object) $request->signature_image);

                // Attach uploaded signature image.
                $this->media->attach($article, $imageEntity, 'signatures');
            } else {
                throw new RuntimeException('Signature image is invalid');
            }
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article updated successfully.');
    }

}
