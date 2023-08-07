<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use App\Controller;
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
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotFindClient
     */
    public function __invoke(string $key): View
    {
        $client = $this->client->find($key);

        $logo = $client->getFirstMedia('logos');

        return ViewFacade::make('ClientPublic::single', compact('client', 'logo'));
    }

}
