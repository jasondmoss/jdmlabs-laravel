<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\StoreUseCase;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;
use Aenginus\Article\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;


    /**
     * @param \Aenginus\Article\Application\UseCases\StoreUseCase $bridge
     */
    public function __construct(StoreUseCase $bridge)
    {
        $this->bridge = $bridge;
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

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Article created successfully.');
    }

}
