<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\DeleteArticleUseCase;
use App\Article\Infrastructure\Article;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected Article $article;

    protected DeleteArticleUseCase $deleteArticle;


    /**
     * @param \App\Article\Infrastructure\Article $article
     * @param \App\Article\Application\UseCases\DeleteArticleUseCase $deleteArticle
     */
    public function __construct(Article $article, DeleteArticleUseCase $deleteArticle)
    {
        $this->article = $article;
        $this->deleteArticle = $deleteArticle;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(string $id): RedirectResponse
    {
        $article = $this->article->find((new Id($id))->value());
        $this->authorize('owner', $article);

        $this->deleteArticle->__invoke($id);

        return redirect()->action(IndexController::class);
    }

}
