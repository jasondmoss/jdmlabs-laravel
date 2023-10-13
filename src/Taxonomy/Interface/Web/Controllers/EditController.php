<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{
    protected CategoryModel $category;


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     */
    public function __construct(CategoryModel $category)
    {
        $this->category = $category;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $id): View
    {
        $category = $this->category->find((new UlidValueObject($id))->value());
        $categories = CategoryModel::where('parent_id', null)->orderby('name')->get();

        return ViewFacade::make('Category::edit', compact('category', 'categories'));
    }
}
