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

    protected DestroyUseCase $conjoins;


    /**
     * @param \App\Article\Infrastructure\Article $article
     * @param \App\Article\Application\UseCases\DestroyUseCase $conjoins
     */
    public function __construct(Article $article, DestroyUseCase $conjoins)
    {
        $this->article = $article;
        $this->conjoins = $conjoins;
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

        $this->conjoins->delete($toBeDeleted);

        return redirect()->action(IndexController::class);
    }

}
