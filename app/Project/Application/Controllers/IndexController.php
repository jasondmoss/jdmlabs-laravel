<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return ViewFacade::make('ProjectAdmin::show');
    }

}
