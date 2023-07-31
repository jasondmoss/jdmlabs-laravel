<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\Exceptions\CouldNotDeleteClient;
use App\Client\Application\UseCases\DestroyUseCase;
use App\Client\Infrastructure\Client;
use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected Client $client;

    protected DestroyUseCase $bridge;


    /**
     * @param \App\Client\Infrastructure\Client $client
     * @param \App\Client\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(Client $client, DestroyUseCase $bridge)
    {
        $this->client = $client;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Client\Application\Exceptions\CouldNotDeleteClient
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->client->find((new Id($id))->value());

        try {
            $this->bridge->delete($toBeDeleted);
        } catch (Exception $exception) {
            throw CouldNotDeleteClient::withId($toBeDeleted->id);
        }

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Client successfully deleted.');
    }

}
