<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\ValueObjects\Id;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected CategoryEloquentModel $category;


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel $category
     */
    public function __construct(CategoryEloquentModel $category)
    {
        $this->category = $category;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $category = $this->category
            ->with('articles')
            ->find((new Id($id))->value());

        return ViewFacade::make('Category::edit', compact('category'));
    }

}
