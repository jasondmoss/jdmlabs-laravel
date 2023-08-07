<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\Exceptions\CouldNotDeleteArticle;
use Aenginus\Article\Application\UseCases\DestroyUseCase;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\ValueObjects\Id;
use App\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected ArticleEloquentModel $article;

    protected DestroyUseCase $bridge;


    /**
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     * @param \Aenginus\Article\Application\UseCases\DestroyUseCase $bridge
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
     * @throws \Aenginus\Article\Application\Exceptions\CouldNotFindArticle
     * @throws \Aenginus\Article\Application\Exceptions\CouldNotDeleteArticle
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
