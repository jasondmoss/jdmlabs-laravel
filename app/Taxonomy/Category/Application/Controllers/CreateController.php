<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $category = new Category();
        $this->authorize('create', $category);

        $categories = Category::all()->sortBy('name', SORT_NUMERIC|SORT_FLAG_CASE);

        return ViewFacade::make('Category::create', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

}
