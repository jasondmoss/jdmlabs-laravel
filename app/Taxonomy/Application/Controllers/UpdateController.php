<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Application\UseCases\UpdateUseCase;
use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Interface\Http\CategoryRequest;
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
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        $this->conjoins->update($request);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Category successfully updated.');
    }

}
