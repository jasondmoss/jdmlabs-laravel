<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface\Web\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Shared\ValueObjects\Id;
use App\Taxonomy\Application\Exceptions\CouldNotDeleteCategory;
use App\Taxonomy\Application\UseCases\DestroyUseCase;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected CategoryEloquentModel $category;

    protected DestroyUseCase $bridge;


    public function __construct(CategoryEloquentModel $category, DestroyUseCase $bridge)
    {
        $this->category = $category;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotDeleteCategory
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
