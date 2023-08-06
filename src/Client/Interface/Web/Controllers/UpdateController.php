<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\UpdateUseCase;
use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\UpdateRequest;
use Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase as MediaUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use App\Controller;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class UpdateController extends Controller
{

    protected ClientEloquentModel $client;

    protected UpdateUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     * @param \Aenginus\Client\Application\UseCases\UpdateUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase $media
     */
    public function __construct(
        ClientEloquentModel $client,
        UpdateUseCase $bridge,
        MediaUseCase $media
    ) {
        $this->client = $client;
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \Aenginus\Client\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotFindClient
     * @throws \ReflectionException
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $clientEntity = new ClientEntity($validated);

        $clientInstance = $this->client->find($clientEntity->id);

        $client = $this->bridge->update($clientInstance, $clientEntity);

        if ($request->hasFile('logo_image')) {
            $logoImage = $request->file('logo_image');

            if ($logoImage['file']->isValid()) {
                $imageEntity = new ImageEntity((object) $request->logo_image);

                // Attach uploaded logo image.
                $this->media->attach($client, $imageEntity, 'logos');
            } else {
                throw new RuntimeException('Logo image is invalid');
            }
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client updated successfully.');
    }

}
