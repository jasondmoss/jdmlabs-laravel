<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Support\Facades\View as ViewFacade;

class IndexController extends Controller
{

    public function __invoke()
    {
        return ViewFacade::make('Category::show', [
            'categories' => Category::all()
                ->sortBy('name', SORT_NUMERIC|SORT_FLAG_CASE)
        ]);
    }

}
