<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\DestroyUseCase;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity;
use Aenginus\Shared\ValueObjects\UlidValueObject;
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
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->article->find((new UlidValueObject($id))->value());

        try {
            $this->bridge->delete($toBeDeleted);
        } catch (Exception $exception) {
            throw CouldNotDeleteModelEntity::withId($toBeDeleted->id);
        }

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Article successfully deleted.');
    }

}
