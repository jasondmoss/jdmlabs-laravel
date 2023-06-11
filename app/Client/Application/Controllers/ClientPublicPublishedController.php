<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetPublishedClientsUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ClientPublicPublishedController extends Controller {

    private GetPublishedClientsUseCase $getPublishedClients;


    public function __construct(GetPublishedClientsUseCase $getPublishedClients)
    {
        $this->getPublishedClients = $getPublishedClients;
    }


    public function __invoke(): View
    {
        $clients = $this->getPublishedClients->__invoke();

        return ViewFacade::make('ClientPublic::show', [
            'clients' => $clients
        ]);
    }

}
