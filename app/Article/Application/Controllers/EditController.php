<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Infrastructure\Article;
use App\Laravel\Application\Controller;
use App\Shared\ValueObjects\Id;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected Article $article;


    /**
     * @param \App\Article\Infrastructure\Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(string $id): View
    {
        $article = $this->article->find((new Id($id))->value());

        $categories = Category::get()->pluck('name', 'id');

        return ViewFacade::make('ArticleAdmin::edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

}
