<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\StoreUseCase;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\SingleImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;
    protected SingleImageUseCase $signature;


    /**
     * @param \Aenginus\Article\Application\UseCases\StoreUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\SingleImageUseCase $signature
     */
    public function __construct(StoreUseCase $bridge, SingleImageUseCase $signature)
    {
        $this->bridge = $bridge;
        $this->signature = $signature;
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

        /**
         * Signature image (single).
         */
        if ($request->hasFile('signature_image')) {
            $this->signature->attach(
                $article,
                (object) $request->signature_image,
                'signature'
            );
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Article created successfully.');
    }

}
