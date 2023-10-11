<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\UpdateUseCase as ClientUseCase;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\UpdateRequest;
use Aenginus\Media\Application\UseCases\StoreImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ClientModel $client;

    protected ClientUseCase $clientUseCase;

    protected StoreImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     * @param \Aenginus\Client\Application\UseCases\UpdateUseCase $clientUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreImageUseCase $imageUseCase
     */
    public function __construct(
        ClientModel $client,
        ClientUseCase $clientUseCase,
        StoreImageUseCase $imageUseCase
    ) {
        $this->client = $client;
        $this->clientUseCase = $clientUseCase;
        $this->imageUseCase = $imageUseCase;
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
        $validated = (object)$request->validated();
        $clientEntity = new ClientEntity($validated);
        $clientInstance = $this->client->find($clientEntity->id);
        $client = $this->clientUseCase->update($clientInstance, $clientEntity);

        $requestImages = [];

        // Logo image.
        if ($request->file('logo_image') !== null) {
            foreach ($request->logo_image as $logo_image) {
                $requestImages[] = (object) $logo_image;
            }
        }

        $this->imageUseCase->store($client, $requestImages);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client updated successfully.');
    }

}
