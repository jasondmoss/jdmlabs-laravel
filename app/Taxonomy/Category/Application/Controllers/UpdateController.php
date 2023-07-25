<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Taxonomy\Category\Application\UseCases\UpdateUseCase;
use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Interface\Http\CategoryRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected Category $category;

    protected UpdateUseCase $conjoins;


    public function __construct(Category $category, UpdateUseCase $conjoins)
    {
        $this->category = $category;
        $this->conjoins = $conjoins;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\Http\CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Taxonomy\Category\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        $this->conjoins->update($request);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Category successfully updated.');
    }

}
