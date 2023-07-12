<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\GetArticleUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected GetArticleUseCase $getArticle;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $getArticle
     */
    public function __construct(GetArticleUseCase $getArticle)
    {
        $this->getArticle = $getArticle;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $id): View
    {
        $article = $this->getArticle->__invoke((new Id($id))->value());
        $this->authorize('owner', $article);

        $categories = Category::all()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);

        return ViewFacade::make('ArticleAdmin::edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

}
