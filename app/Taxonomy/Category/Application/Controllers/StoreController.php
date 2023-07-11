<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Taxonomy\Category\Application\UseCases\SaveCategoryUseCase;
use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\CategoryFormRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class StoreController extends Controller
{

    protected SaveCategoryUseCase $saveCategory;


    /**
     * @param \App\Taxonomy\Category\Application\UseCases\SaveCategoryUseCase $saveCategory
     */
    public function __construct(SaveCategoryUseCase $saveCategory)
    {
        $this->saveCategory = $saveCategory;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\CategoryFormRequest $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(CategoryFormRequest $request): View
    {
        $this->authorize('create', Category::class);

        $category = $this->saveCategory->__invoke($request);

        return ViewFacade::make('Category::create');
    }

}
