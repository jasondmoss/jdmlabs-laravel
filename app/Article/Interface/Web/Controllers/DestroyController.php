<?php

declare(strict_types=1);

namespace App\Article\Interface\Web\Controllers;

use App\Article\Application\Exceptions\CouldNotDeleteArticle;
use App\Article\Application\UseCases\DestroyUseCase;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\ValueObjects\Id;
use App\Core\Laravel\Application\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected ArticleEloquentModel $article;

    protected DestroyUseCase $bridge;


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     * @param \App\Article\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(ArticleEloquentModel $article, DestroyUseCase $bridge)
    {
        $this->article = $article;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     * @throws \App\Article\Application\Exceptions\CouldNotDeleteArticle
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->article->find((new Id($id))->value());

        try {
            $this->bridge->delete($toBeDeleted);
        } catch (Exception $exception) {
            throw CouldNotDeleteArticle::withId($toBeDeleted->id);
        }

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Article successfully deleted.');
    }

}
