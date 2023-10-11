<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\StoreUseCase;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\StoreImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $ClientUseCase;

    protected StoreImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Client\Application\UseCases\StoreUseCase $ClientUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreImageUseCase $imageUseCase
     */
    public function __construct(
        StoreUseCase $ClientUseCase,
        StoreImageUseCase $imageUseCase
    ) {
        $this->ClientUseCase = $ClientUseCase;
        $this->imageUseCase = $imageUseCase;
    }


    /**
     * @param \Aenginus\Client\Interface\Web\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \ReflectionException
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object)$request->validated();

        $clientEntity = new ClientEntity($validated);

        $client = $this->ClientUseCase->store($clientEntity);

        $requestImages = [];

        // Logo image.
        if ($request->file('logo_image') !== null) {
            foreach ($request->logo_image as $logo_image) {
                $requestImages[] = (object) $logo_image;
            }
        }

        $this->imageUseCase->store($client, $requestImages);

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Client created successfully.');
    }

}
