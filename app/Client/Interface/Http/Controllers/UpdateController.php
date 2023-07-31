<?php

declare(strict_types=1);

namespace App\Client\Interface\Http\Controllers;

use App\Client\Application\UseCases\UpdateUseCase;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Client\Infrastructure\Entities\ClientEntity;
use App\Client\Interface\Http\Requests\UpdateRequest;
use App\Core\Laravel\Application\Controller;
use App\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use App\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ClientEloquentModel $client;

    protected UpdateUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     * @param \App\Client\Application\UseCases\UpdateUseCase $bridge
     * @param \App\Media\Application\UseCases\AttachUseCase $media
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
     * @param \App\Client\Interface\Http\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $clientEntity = new ClientEntity($validated);

        $clientInstance = $this->client->find($clientEntity->id);

        $client = $this->bridge->update($clientInstance, $clientEntity);

        if ($request->hasFile('logo')) {
            $imageEntity = new ImageEntity((object) $request->logo);

            // Attach uploaded logo image.
            $this->media->attach($client, $imageEntity, 'logos');
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client updated successfully.');
    }

}