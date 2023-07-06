<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers\Admin;

use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ListTaxonomiesController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return ViewFacade::make('TaxonomyAdmin::show');
    }

}
