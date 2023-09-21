<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Domain\Models\ClientModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private ClientModel $client;


    public function __construct(ClientModel $client)
    {
        $this->client = $client;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $key): View
    {
        $client = $this->client->find($key);
        $logo = $client->getFirstMedia('logo');

        return ViewFacade::make('ClientPublic::single', compact('client', 'logo'));
    }

}
