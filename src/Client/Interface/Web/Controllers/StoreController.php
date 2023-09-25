<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\StoreUseCase;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;


    /**
     * @param \Aenginus\Client\Application\UseCases\StoreUseCase $bridge
     */
    public function __construct(StoreUseCase $bridge)
    {
        $this->bridge = $bridge;
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

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Client created successfully.');
    }

}
