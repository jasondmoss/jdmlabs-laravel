<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetPromotedClientsUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ClientPublicPromotedController extends Controller {

    private GetPromotedClientsUseCase $getPromotedClients;


    /**
     * @param \App\Client\Application\UseCases\GetPromotedClientsUseCase $getPromotedClients
     */
    public function __construct(GetPromotedClientsUseCase $getPromotedClients)
    {
        $this->getPromotedClients = $getPromotedClients;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = $this->getPromotedClients->__invoke();

        return ViewFacade::make('ClientPublic::show', [
            'clients' => $clients
        ]);
    }

}
