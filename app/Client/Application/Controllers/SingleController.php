<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private GetClientUseCase $getClient;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $getClient
     */
    public function __construct(GetClientUseCase $getClient)
    {
        $this->getClient = $getClient;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $key): View
    {
        $client = $this->getClient->__invoke($key);

        return ViewFacade::make('ClientPublic::single', [
            'client' => $client
        ]);
    }

}
