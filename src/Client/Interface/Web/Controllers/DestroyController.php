<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\DestroyUseCase;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use App\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected ClientEloquentModel $client;
    protected DestroyUseCase $bridge;


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
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
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->client->find((new UlidValueObject($id))->value());

        try {
            $this->bridge->delete($toBeDeleted);
        } catch (Exception $exception) {
            throw CouldNotDeleteModelEntity::withId($toBeDeleted->id);
        }

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Client successfully deleted.');
    }

}
