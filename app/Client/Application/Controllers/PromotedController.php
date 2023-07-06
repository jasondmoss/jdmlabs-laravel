<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetPromotedClientsUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PromotedController extends Controller
{

    private GetPromotedClientsUseCase $getPromoted;


    /**
     * @param \App\Client\Application\UseCases\GetPromotedClientsUseCase $getPromoted
     */
    public function __construct(GetPromotedClientsUseCase $getPromoted)
    {
        $this->getPromoted = $getPromoted;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = $this->getPromoted->__invoke();

        return ViewFacade::make('ClientPublic::show', [
            'clients' => $clients
        ]);
    }

}
