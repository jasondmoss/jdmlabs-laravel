<?php

declare(strict_types=1);

namespace App\Client\Interface\Http\Controllers;

use App\Client\Application\UseCases\StoreUseCase;
use App\Client\Infrastructure\Entities\ClientEntity;
use App\Client\Interface\Http\Requests\CreateRequest;
use App\Core\Laravel\Application\Controller;
use App\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use App\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \App\Client\Application\UseCases\StoreUseCase $bridge
     * @param \App\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(StoreUseCase $bridge, MediaUseCase $media)
    {
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \App\Client\Interface\Http\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $clientEntity = new ClientEntity($validated);

        $client = $this->bridge->store($clientEntity);

        if ($request->hasFile('logo')) {
            $imageEntity = new ImageEntity((object) $request->logo);

            // Attach uploaded logo image.
            $this->media->attach($client, $imageEntity, 'logos');
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Client created successfully.');
    }

}
