<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

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
        /*$categories = Category::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        return ViewFacade::make('ClientAdmin::create', [
            'categories' => $categories
        ]);*/

        return ViewFacade::make('ClientAdmin::create');
    }

}
