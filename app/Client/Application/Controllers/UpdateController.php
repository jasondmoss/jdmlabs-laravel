<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Client\Application\UseCases\SaveClientUseCase;
use App\Client\Interface\ClientFormRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected GetClientUseCase $getClient;

    protected SaveClientUseCase $saveClient;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $getClient
     * @param \App\Client\Application\UseCases\SaveClientUseCase $saveClient
     */
    public function __construct(GetClientUseCase $getClient, SaveClientUseCase $saveClient)
    {
        $this->getClient = $getClient;
        $this->saveClient = $saveClient;
    }


    /**
     * @param \App\Client\Interface\ClientFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(ClientFormRequest $request): RedirectResponse
    {
        $client = $this->getClient->__invoke($request->id);
        $this->authorize('owner', $client);

        $this->saveClient->__invoke($request);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client successfully updated');
    }

}
