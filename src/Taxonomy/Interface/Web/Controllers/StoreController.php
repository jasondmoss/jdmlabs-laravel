<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Taxonomy\Application\UseCases\StoreUseCase;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;
use Aenginus\Taxonomy\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;


    /**
     * @param \Aenginus\Taxonomy\Application\UseCases\StoreUseCase $bridge
     */
    public function __construct(StoreUseCase $bridge)
    {
        $this->bridge = $bridge;
    }


    /**
     * @param \Aenginus\Taxonomy\Interface\Web\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $categoryEntity = new CategoryEntity($validated);

        $this->bridge->store($categoryEntity);

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Category created successfully.');
    }

}