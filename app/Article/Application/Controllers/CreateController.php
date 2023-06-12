<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Infrastructure\Article;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller {

    public function __construct() {}


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $article = new Article();
        $this->authorize('create', $article);

//        $article->categories = Category::get()->pluck('id', 'name');

        return ViewFacade::make('ArticleAdmin::create', [
            'article' => $article
        ]);
    }

}
