<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\UpdateUseCase;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\UpdateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ClientModel $client;
    protected UpdateUseCase $bridge;


    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     * @param \Aenginus\Client\Application\UseCases\UpdateUseCase $bridge
     */
    public function __construct(ClientModel $client, UpdateUseCase $bridge)
    {
        $this->client = $client;
        $this->bridge = $bridge;
    }


    /**
     * @param \Aenginus\Client\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     * @throws \ReflectionException
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $clientEntity = new ClientEntity($validated);
        $clientInstance = $this->client->find($clientEntity->id);
        $client = $this->bridge->update($clientInstance, $clientEntity);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client updated successfully.');
    }

}
