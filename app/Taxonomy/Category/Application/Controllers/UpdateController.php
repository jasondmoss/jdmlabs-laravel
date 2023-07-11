<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Taxonomy\Category\Application\UseCases\GetCategoryUseCase;
use App\Taxonomy\Category\Application\UseCases\SaveCategoryUseCase;
use App\Taxonomy\Category\Interface\CategoryFormRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected GetCategoryUseCase $getCategory;

    protected SaveCategoryUseCase $updateCategory;


    /**
     * @param \App\Taxonomy\Category\Application\UseCases\GetCategoryUseCase $getCategory
     * @param \App\Taxonomy\Category\Application\UseCases\SaveCategoryUseCase $updateCategory
     */
    public function __construct(
        GetCategoryUseCase $getCategory,
        SaveCategoryUseCase $updateCategory
    ) {
        $this->getCategory = $getCategory;
        $this->updateCategory = $updateCategory;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\CategoryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CategoryFormRequest $request): RedirectResponse
    {
        if (! empty($request->id)) {
            $category = $this->getCategory->__invoke($request->id);

            $this->authorize('owner', $category);
        }

        $category = $this->updateCategory->__invoke($request);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Category successfully updated.');
    }

}
