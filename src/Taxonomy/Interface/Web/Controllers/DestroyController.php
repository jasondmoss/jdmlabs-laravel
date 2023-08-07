<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Taxonomy\Application\Exceptions\CouldNotDeleteCategory;
use Aenginus\Taxonomy\Application\UseCases\DestroyUseCase;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\ValueObjects\Id;
use App\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected CategoryEloquentModel $category;

    protected DestroyUseCase $bridge;


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     * @param \Aenginus\Taxonomy\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(CategoryEloquentModel $category, DestroyUseCase $bridge)
    {
        $this->category = $category;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Taxonomy\Application\Exceptions\CouldNotFindCategory
     * @throws \Aenginus\Taxonomy\Application\Exceptions\CouldNotDeleteCategory
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->category->find((new Id($id))->value());

        try {
            $this->bridge->delete($toBeDeleted);
        } catch (Exception $exception) {
            throw CouldNotDeleteCategory::withId($toBeDeleted->id);
        }

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Category successfully deleted.');
    }

}
