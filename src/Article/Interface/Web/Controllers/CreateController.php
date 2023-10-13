<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Domain\Models\ArticleModel;
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
        $article = new ArticleModel();

        $categories = CategoryModel::get()->pluck('name', 'id');

        return ViewFacade::make(
            'ArticleAdmin::create', compact('article', 'categories')
        );
    }
}
