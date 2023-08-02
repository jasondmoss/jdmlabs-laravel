<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface\Http\Web\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Application\UseCases\StoreUseCase;
use App\Taxonomy\Infrastructure\Entities\CategoryEntity;
use App\Taxonomy\Interface\Http\Web\Requests\CreateRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;


    /**
     * @param \App\Taxonomy\Application\UseCases\StoreUseCase $bridge
     */
    public function __construct(StoreUseCase $bridge)
    {
        $this->bridge = $bridge;
    }


    /**
     * @param \App\Taxonomy\Interface\Http\Web\Requests\CreateRequest $request
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
