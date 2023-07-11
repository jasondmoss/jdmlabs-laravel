<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Infrastructure\Article;
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
        $article = new Article();
        $this->authorize('create', $article);

//        $article->categories = Category::get()->pluck('id', 'name');
        $categories = Category::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        return ViewFacade::make('ArticleAdmin::create', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

}
