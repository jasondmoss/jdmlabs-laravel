<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Shared\ValueObjects\Id;
use App\Taxonomy\Category\Application\UseCases\GetCategoryUseCase;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected Category $category;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Taxonomy\Category\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(string $id): View
    {
        $category = $this->category->find((new Id($id))->value());

        return ViewFacade::make('Category::edit', [
            'category' => $category
        ]);
    }

}
