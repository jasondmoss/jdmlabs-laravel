<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface\Http\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Application\UseCases\UpdateUseCase;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use App\Taxonomy\Infrastructure\Entities\CategoryEntity;
use App\Taxonomy\Interface\Http\Requests\UpdateRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected CategoryEloquentModel $category;

    protected UpdateUseCase $bridge;


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     * @param \App\Taxonomy\Application\UseCases\UpdateUseCase $bridge
     */
    public function __construct(CategoryEloquentModel $category, UpdateUseCase $bridge)
    {
        $this->category = $category;
        $this->bridge = $bridge;
    }


    /**
     * @param \App\Taxonomy\Interface\Http\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $categoryEntity = new CategoryEntity($validated);

        $categoryInstance = $this->category->find($categoryEntity->id);

        $this->bridge->update($categoryInstance, $categoryEntity);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Category successfully updated.');
    }

}
