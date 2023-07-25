<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

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
        $categories = Category::get()->pluck('name', 'id');

        return ViewFacade::make('ArticleAdmin::create', [
            'categories' => $categories
        ]);
    }

}
