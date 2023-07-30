<?php

declare(strict_types=1);

namespace App\Article\Interface\Http\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Infrastructure\Category;
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
