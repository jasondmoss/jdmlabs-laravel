<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetPinnedClientsUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PinnedController extends Controller
{

    private GetPinnedClientsUseCase $getPinned;


    /**
     * @param \App\Client\Application\UseCases\GetPinnedClientsUseCase $getPinned
     */
    public function __construct(GetPinnedClientsUseCase $getPinned)
    {
        $this->getPinned = $getPinned;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = $this->getPinned->__invoke();

        return ViewFacade::make('ClientPublic::show', [
            'clients' => $clients
        ]);
    }

}
