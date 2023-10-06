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

    protected StoreUseCase $categoryUseCase;


    /**
     * @param \Aenginus\Taxonomy\Application\UseCases\StoreUseCase $categoryUseCase
     */
    public function __construct(StoreUseCase $categoryUseCase)
    {
        $this->categoryUseCase = $categoryUseCase;
    }


    /**
     * @param \Aenginus\Taxonomy\Interface\Web\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object)$request->validated();
        $categoryEntity = new CategoryEntity($validated);

        $this->categoryUseCase->store($categoryEntity);

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Category created successfully.');
    }

}
