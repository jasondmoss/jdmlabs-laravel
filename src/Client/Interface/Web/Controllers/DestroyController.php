<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\Exceptions\CouldNotDeleteClient;
use Aenginus\Client\Application\UseCases\DestroyUseCase;
use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use Aenginus\Client\Infrastructure\ValueObjects\Id;
use App\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected ClientEloquentModel $client;

    protected DestroyUseCase $bridge;


    /**
     * @param \Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     * @param \Aenginus\Client\Application\UseCases\DestroyUseCase $bridge
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
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotDeleteClient
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotFindClient
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
