<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\StoreUseCase;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \Aenginus\Client\Application\UseCases\StoreUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(StoreUseCase $bridge, MediaUseCase $media)
    {
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \Aenginus\Client\Interface\Web\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \ReflectionException
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $clientEntity = new ClientEntity($validated);

        $client = $this->bridge->store($clientEntity);

        if ($request->hasFile('logo_image')) {
            $imageEntity = new ImageEntity((object) $request->logo_image);

            // Attach uploaded logo image.
            $this->media->attach($client, $imageEntity, 'logos');
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Client created successfully.');
    }

}
