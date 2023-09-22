<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\UpdateUseCase as ArticleUseCase;
use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\UpdateRequest;
use Aenginus\Media\Application\UseCases\SingleImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ArticleModel $article;
    protected ArticleUseCase $bridge;
    protected SingleImageUseCase $signature;


    /**
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     * @param \Aenginus\Article\Application\UseCases\UpdateUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\SingleImageUseCase $signature
     */
    public function __construct(
        ArticleModel $article,
        ArticleUseCase $bridge,
        SingleImageUseCase $signature
    ) {
        $this->article = $article;
        $this->bridge = $bridge;
        $this->signature = $signature;
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
        $article = $this->bridge->update($articleInstance, $articleEntity);

        // Signature image (single).
        /*if ($request->hasFile('signature_image')) {
            $this->signature->attach(
                $article,
                (object) $request->signature_image,
                'signature'
            );
        }*/

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Article updated successfully.');
    }

}
