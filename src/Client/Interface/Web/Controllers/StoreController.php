<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\StoreUseCase;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\StoreSingleImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $ClientUseCase;

    protected StoreSingleImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Client\Application\UseCases\StoreUseCase $ClientUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreSingleImageUseCase $imageUseCase
     */
    public function __construct(
        StoreUseCase $ClientUseCase,
        StoreSingleImageUseCase $imageUseCase
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

        // Logo image (single).
        if ($request->hasFile('logo_image')) {
            $this->imageUseCase->store(
                $client,
                (object) $request->logo_image
            );
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Client created successfully.');
    }

}
