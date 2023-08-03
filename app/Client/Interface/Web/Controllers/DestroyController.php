<?php

declare(strict_types=1);

namespace App\Client\Interface\Web\Controllers;

use App\Client\Application\Exceptions\CouldNotDeleteClient;
use App\Client\Application\UseCases\DestroyUseCase;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Client\Infrastructure\ValueObjects\Id;
use App\Core\Laravel\Application\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected ClientEloquentModel $client;

    protected DestroyUseCase $bridge;


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     * @param \App\Client\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(ClientEloquentModel $client, DestroyUseCase $bridge)
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
