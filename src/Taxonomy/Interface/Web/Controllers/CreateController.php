<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $categories = CategoryModel::where('parent_id', null)
            ->orderby('name', 'asc')
            ->get();

        return ViewFacade::make('Category::create', compact('categories'));
    }

}
