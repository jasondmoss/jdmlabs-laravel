<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetPinnedClientsUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ClientPublicPinnedController extends Controller {

    private GetPinnedClientsUseCase $getPinnedClients;


    /**
     * @param \App\Client\Application\UseCases\GetPinnedClientsUseCase $getPinnedClients
     */
    public function __construct(GetPinnedClientsUseCase $getPinnedClients)
    {
        $this->getPinnedClients = $getPinnedClients;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = $this->getPinnedClients->__invoke();

        return ViewFacade::make('ClientPublic::show', [
            'clients' => $clients
        ]);
    }

}
