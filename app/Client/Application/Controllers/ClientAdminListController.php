<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ClientAdminListController extends Controller {

    public function __invoke(): View
    {
        return ViewFacade::make('ClientAdmin::show');
    }

}
