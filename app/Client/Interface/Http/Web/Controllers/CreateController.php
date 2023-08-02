<?php

declare(strict_types=1);

namespace App\Client\Interface\Http\Web\Controllers;

use App\Core\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return ViewFacade::make('ClientAdmin::create');
    }

}
