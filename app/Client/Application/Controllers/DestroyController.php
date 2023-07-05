<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\DeleteClientUseCase;
use App\Client\Application\UseCases\GetClientUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DestroyController extends Controller {

    protected GetClientUseCase $getClient;

    protected DeleteClientUseCase $deleteClient;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $getClient
     * @param \App\Client\Application\UseCases\DeleteClientUseCase $deleteClient
     */
    public function __construct(
        GetClientUseCase $getClient,
        DeleteClientUseCase $deleteClient
    ) {
        $this->getClient = $getClient;
        $this->deleteClient = $deleteClient;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $id): Redirector|RedirectResponse
    {
        $client = $this->getClient->__invoke((new Id($id))->value());
        $this->authorize('create', $client);

        $this->deleteClient->__invoke($id);

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'The client has been successfully deleted.');
    }

}
