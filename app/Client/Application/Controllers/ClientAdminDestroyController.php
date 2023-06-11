<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\DeleteClientUseCase;
use App\Client\Application\UseCases\GetClientUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ClientAdminDestroyController extends Controller {

    protected DeleteClientUseCase $deleteClient;

    protected GetClientUseCase $getClient;


    public function __construct(
        DeleteClientUseCase $deleteClient,
        GetClientUseCase $getClient
    )
    {
        $this->deleteClient = $deleteClient;
        $this->getClient = $getClient;
    }


    public function __invoke(string $id): Redirector|RedirectResponse
    {
        $client = $this->getClient->__invoke((new Id($id))->value());
        $this->authorize('create', $client);

        $this->deleteClient->__invoke($id);

        return redirect()
            ->route('admin.clients')
            ->with('delete', 'The client has been successfully deleted.');
    }

}
