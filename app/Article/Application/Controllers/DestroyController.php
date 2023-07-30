<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\DestroyUseCase;
use App\Article\Infrastructure\Article;
use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected Article $article;

    protected DestroyUseCase $bridge;


    /**
     * @param \App\Article\Infrastructure\Article $article
     * @param \App\Article\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(Article $article, DestroyUseCase $bridge)
    {
        $this->article = $article;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->article->find((new Id($id))->value());

        $this->bridge->delete($toBeDeleted);

        return redirect()->action(IndexController::class);
    }

}
