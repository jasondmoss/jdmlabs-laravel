<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Infrastructure\Client;
use App\Core\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private Client $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function __invoke(string $key): View
    {
        $client = $this->client->find($key);

        return ViewFacade::make('ClientPublic::single', [
            'client' => $client
        ]);
    }

}
