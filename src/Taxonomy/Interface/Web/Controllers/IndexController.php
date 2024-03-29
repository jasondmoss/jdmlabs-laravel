<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return ViewFacade::make('Category::show');
    }
}
