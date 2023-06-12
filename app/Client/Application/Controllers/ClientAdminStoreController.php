<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\SaveClientUseCase;
use App\Client\Infrastructure\Client;
use App\Laravel\Application\Controller;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;

class ClientAdminStoreController extends Controller {

    protected SaveClientUseCase $save;


    /**
     * @param \App\Client\Application\UseCases\SaveClientUseCase $save
     */
    public function __construct(SaveClientUseCase $save)
    {
        $this->save = $save;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $this->authorize('create', Client::class);

        $this->save->__invoke($request);

        return redirect()
            ->route('admin.clients')
            ->with('create', 'The client was created successfully.');
    }

}
