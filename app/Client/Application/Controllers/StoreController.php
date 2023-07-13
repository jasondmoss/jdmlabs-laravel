<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\SaveClientUseCase;
use App\Client\Infrastructure\Client;
use App\Client\Interface\ClientFormRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected SaveClientUseCase $saveClient;


    /**
     * @param \App\Client\Application\UseCases\SaveClientUseCase $saveClient
     */
    public function __construct(SaveClientUseCase $saveClient)
    {
        $this->saveClient = $saveClient;
    }


    /**
     * @param \App\Client\Interface\ClientFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ClientFormRequest $request): RedirectResponse
    {
        $this->authorize('create', Client::class);

        $this->saveClient->__invoke($request);

        return redirect()->action(IndexController::class);
    }

}
