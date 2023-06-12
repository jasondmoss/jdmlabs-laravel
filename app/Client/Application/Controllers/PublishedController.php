<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetPublishedClientsUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller {

    private GetPublishedClientsUseCase $getPublished;


    /**
     * @param \App\Client\Application\UseCases\GetPublishedClientsUseCase $getPublished
     */
    public function __construct(GetPublishedClientsUseCase $getPublished)
    {
        $this->getPublished = $getPublished;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = $this->getPublished->__invoke();

        return ViewFacade::make('ClientPublic::show', [
            'clients' => $clients
        ]);
    }

}
