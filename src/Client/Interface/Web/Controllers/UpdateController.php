<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\UpdateUseCase;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\UpdateRequest;
use Aenginus\Media\Application\UseCases\StoreSingleImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ClientModel $client;

    protected UpdateUseCase $ClientUseCase;

    protected StoreSingleImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     * @param \Aenginus\Client\Application\UseCases\UpdateUseCase $ClientUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreSingleImageUseCase $imageUseCase
     */
    public function __construct(
        ClientModel $client,
        UpdateUseCase $ClientUseCase,
        StoreSingleImageUseCase $imageUseCase
    ) {
        $this->client = $client;
        $this->ClientUseCase = $ClientUseCase;
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
        $client = $this->ClientUseCase->update($clientInstance, $clientEntity);

        // Logo image (single).
        if ($request->hasFile('logo_image')) {
            $this->imageUseCase->store(
                $client,
                (object) $request->logo_image
            );
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client updated successfully.');
    }

}
