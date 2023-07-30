<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\UpdateUseCase;
use App\Client\Infrastructure\Client;
use App\Client\Interface\Http\UpdateRequest;
use App\Core\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected Client $client;

    protected UpdateUseCase $bridge;


    /**
     * @param \App\Client\Infrastructure\Client $client
     * @param \App\Client\Application\UseCases\UpdateUseCase $bridge
     */
    public function __construct(Client $client, UpdateUseCase $bridge)
    {
        $this->client = $client;
        $this->bridge = $bridge;
    }


    /**
     * @param \App\Client\Interface\Http\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $client = $this->bridge->update($request);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client successfully updated');
    }

}
