<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\DeleteArticleUseCase;
use App\Article\Application\UseCases\GetArticleUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DestroyController extends Controller
{

    protected GetArticleUseCase $getArticle;

    protected DeleteArticleUseCase $deleteArticle;


    /**
     * @param \App\Article\Application\UseCases\GetArticleUseCase $getArticle
     * @param \App\Article\Application\UseCases\DeleteArticleUseCase $deleteArticle
     */
    public function __construct(
        GetArticleUseCase $getArticle,
        DeleteArticleUseCase $deleteArticle
    )
    {
        $this->getArticle = $getArticle;
        $this->deleteArticle = $deleteArticle;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $id): Redirector|RedirectResponse
    {
        $article = $this->getArticle->__invoke((new Id($id))->value());
        $this->authorize('owner', $article);

        $this->deleteArticle->__invoke($id);

        return redirect()->action(IndexController::class);
    }

}
