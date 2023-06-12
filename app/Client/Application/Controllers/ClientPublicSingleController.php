<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ClientPublicSingleController extends Controller {

    private GetClientUseCase $get;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $get
     */
    public function __construct(GetClientUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $key): View
    {
        $client = $this->get->__invoke($key);

        return ViewFacade::make('ClientPublic::single', [
            'client' => $client
        ]);
    }

}
