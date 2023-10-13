<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Taxonomy\Application\UseCases\UpdateUseCase;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;
use Aenginus\Taxonomy\Interface\Web\Requests\UpdateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    protected CategoryModel $category;

    protected UpdateUseCase $categoryUseCase;


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     * @param \Aenginus\Taxonomy\Application\UseCases\UpdateUseCase $categoryUseCase
     */
    public function __construct(CategoryModel $category, UpdateUseCase $categoryUseCase)
    {
        $this->category = $category;
        $this->categoryUseCase = $categoryUseCase;
    }


    /**
     * @param \Aenginus\Taxonomy\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $categoryEntity = new CategoryEntity($validated);
        $categoryInstance = $this->category->find($categoryEntity->id);

        $category = $this->categoryUseCase->update($categoryInstance, $categoryEntity);

        $keyword = '"<span class="font-bold">' . $category->name . '</span>"';

        return redirect()
            ->to($request->listing_page)
            ->with('update', "{$keyword} successfully updated.");
    }
}
