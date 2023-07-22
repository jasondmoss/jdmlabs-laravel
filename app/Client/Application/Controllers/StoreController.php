<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\StoreUseCase;
use App\Client\Interface\Requests\Http\CreateRequest;
use App\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $conjoins;


    /**
     * @param \App\Client\Application\UseCases\StoreUseCase $conjoins
     */
    public function __construct(StoreUseCase $conjoins)
    {
        $this->conjoins = $conjoins;
    }


    public function __invoke(CreateRequest $request): RedirectResponse
    {
        // Store + return client.
        $client = $this->conjoins->store($request);

        return redirect()->action(IndexController::class);
    }

}
