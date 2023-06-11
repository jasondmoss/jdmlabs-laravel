<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Client\Application\UseCases\SaveClientUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;

class ClientAdminUpdateController extends Controller {

    protected SaveClientUseCase $saveClient;

    protected GetClientUseCase $getClient;


    /**
     * @param \App\Client\Application\UseCases\SaveClientUseCase $saveClient
     * @param \App\Client\Application\UseCases\GetClientUseCase $getClient
     */
    public function __construct(
        SaveClientUseCase $saveClient,
        GetClientUseCase $getClient
    )
    {
        $this->saveClient = $saveClient;
        $this->getClient = $getClient;
    }


    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $client = $this->getClient->__invoke($request->id);
        $this->authorize('owner', $client);

        $this->saveClient->__invoke($request);

        return redirect()
            ->route('admin.clients')
            ->with('update', 'The client has been updated successfully.');
    }

}
