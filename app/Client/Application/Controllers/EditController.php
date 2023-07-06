<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected GetClientUseCase $getClient;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $getClient
     */
    public function __construct(GetClientUseCase $getClient)
    {
        $this->getClient = $getClient;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $client = $this->getClient->__invoke($id);

        $this->authorize('owner', $client);

        return ViewFacade::make('ClientAdmin::edit', [
            'client' => $client
        ]);
    }

}
