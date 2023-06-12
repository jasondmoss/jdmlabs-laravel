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

    protected GetArticleUseCase $get;

    protected DeleteArticleUseCase $delete;


    /**
     * @param \App\Article\Application\UseCases\DeleteArticleUseCase $delete
     * @param \App\Article\Application\UseCases\GetArticleUseCase $get
     */
    public function __construct(GetArticleUseCase $get, DeleteArticleUseCase $delete)
    {
        $this->get = $get;
        $this->delete = $delete;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
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
