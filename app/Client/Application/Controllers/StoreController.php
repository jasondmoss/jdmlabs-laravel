<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\StoreUseCase;
use App\Client\Interface\Http\CreateRequest;
use App\Core\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;


    /**
     * @param \App\Client\Application\UseCases\StoreUseCase $bridge
     */
    public function __construct(StoreUseCase $bridge)
    {
        $this->bridge = $bridge;
    }


    public function __invoke(CreateRequest $request): RedirectResponse
    {
        // Store + return client.
        $client = $this->bridge->store($request);

        return redirect()->action(IndexController::class);
    }

}
