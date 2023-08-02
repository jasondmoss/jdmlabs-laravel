<?php

declare(strict_types=1);

namespace App\Client\Interface\Web\Controllers;

use App\Client\Application\UseCases\GetPublishedClientsUseCase;
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
        return ViewFacade::make('ClientPublic::show');
    }

}
