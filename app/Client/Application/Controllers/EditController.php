<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Client\Infrastructure\Client;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected Client $client;


    /**
     * @param \App\Client\Infrastructure\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function __invoke(string $id): View
    {
        $client = $this->client->find($id);

        return ViewFacade::make('ClientAdmin::edit', [
            'client' => $client
        ]);
    }

}
