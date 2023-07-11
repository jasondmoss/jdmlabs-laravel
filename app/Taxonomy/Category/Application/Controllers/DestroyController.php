<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use App\Taxonomy\Category\Application\UseCases\DeleteCategoryUseCase;
use App\Taxonomy\Category\Application\UseCases\GetCategoryUseCase;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected GetCategoryUseCase $getCategory;

    protected DeleteCategoryUseCase $deleteCategory;


    /**
     * @param \App\Taxonomy\Category\Application\UseCases\GetCategoryUseCase $getCategory
     * @param \App\Taxonomy\Category\Application\UseCases\DeleteCategoryUseCase $deleteCategory
     */
    public function __construct(
        GetCategoryUseCase $getCategory,
        DeleteCategoryUseCase $deleteCategory
    )
    {
        $this->getCategory = $getCategory;
        $this->deleteCategory = $deleteCategory;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $id): RedirectResponse
    {
        $category = $this->getCategory->__invoke((new Id($id))->value());
        $this->authorize('owner', $category);

        $this->deleteCategory->__invoke($id);

        return redirect()->action(IndexController::class);
    }

}
