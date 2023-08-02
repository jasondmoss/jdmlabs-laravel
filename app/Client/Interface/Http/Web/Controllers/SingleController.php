<?php

declare(strict_types=1);

namespace App\Client\Interface\Http\Web\Controllers;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private ClientEloquentModel $client;


    public function __construct(ClientEloquentModel $client)
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

        $logo = $client->getFirstMedia('logos');

        return ViewFacade::make('ClientPublic::single', [
            'client' => $client,
            'logo' => $logo
        ]);
    }

}
