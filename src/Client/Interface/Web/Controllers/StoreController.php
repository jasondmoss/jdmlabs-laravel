<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\StoreUseCase;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\CreateRequest;
use Aenginus\Media\Application\UseCases\SingleImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;

    protected SingleImageUseCase $logo;


    /**
     * @param \Aenginus\Client\Application\UseCases\StoreUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\SingleImageUseCase $logo
     */
    public function __construct(StoreUseCase $bridge, SingleImageUseCase $logo)
    {
        $this->bridge = $bridge;
        $this->logo = $logo;
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

        /**
         * Logo image (single).
         */
        if ($request->hasFile('logo_image')) {
            $this->logo->attach(
                $client,
                (object) $request->file('logo_image'),
                'logo'
            );
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Client created successfully.');
    }

}
