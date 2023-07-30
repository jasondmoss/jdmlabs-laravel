<?php

declare(strict_types=1);

namespace App\Project\Interface\Http\Controllers;

use App\Core\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return ViewFacade::make('ProjectPublic::show');
    }

}
