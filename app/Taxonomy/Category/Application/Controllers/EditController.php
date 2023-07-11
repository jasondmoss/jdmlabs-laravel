<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use App\Taxonomy\Category\Application\UseCases\GetCategoryUseCase;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected GetCategoryUseCase $getCategory;


    /**
     * @param \App\Taxonomy\Category\Application\UseCases\GetCategoryUseCase $getCategory
     */
    public function __construct(GetCategoryUseCase $getCategory)
    {
        $this->getCategory = $getCategory;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $category = $this->getCategory->__invoke((new Id($id))->value());
        $this->authorize('create', $category);

        return ViewFacade::make('Category::edit', [
            'category' => $category
        ]);
    }

}
