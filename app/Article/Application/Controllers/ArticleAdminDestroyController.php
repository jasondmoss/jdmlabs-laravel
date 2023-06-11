<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\DeleteArticleUseCase;
use App\Article\Application\UseCases\GetArticleUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ArticleAdminDestroyController extends Controller {

    protected DeleteArticleUseCase $delete;

    protected GetArticleUseCase $get;


    /**
     * @param \App\Article\Application\UseCases\DeleteArticleUseCase $delete
     * @param \App\Article\Application\UseCases\GetArticleUseCase $get
     */
    public function __construct(DeleteArticleUseCase $delete, GetArticleUseCase $get)
    {
        $this->delete = $delete;
        $this->get = $get;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $id): Redirector|RedirectResponse
    {
        $article = $this->get->__invoke((new Id($id))->value());
        $this->authorize('owner', $article);

        $this->delete->__invoke($id);

        return redirect()
            ->route('admin.articles')
            ->with('delete', 'The article has been successfully deleted.');
    }

}
