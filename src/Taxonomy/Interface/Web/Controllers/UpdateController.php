<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Taxonomy\Application\UseCases\UpdateUseCase;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;
use Aenginus\Taxonomy\Interface\Web\Requests\UpdateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected CategoryEloquentModel $category;

    protected UpdateUseCase $bridge;


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     * @param \Aenginus\Taxonomy\Application\UseCases\UpdateUseCase $bridge
     */
    public function __construct(CategoryEloquentModel $category, UpdateUseCase $bridge)
    {
        $this->category = $category;
        $this->bridge = $bridge;
    }


    /**
     * @param \Aenginus\Taxonomy\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Taxonomy\Application\Exceptions\CouldNotFindCategory
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