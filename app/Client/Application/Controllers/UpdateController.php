<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Client\Application\UseCases\SaveClientUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller {

    protected GetClientUseCase $get;

    protected SaveClientUseCase $save;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $get
     * @param \App\Client\Application\UseCases\SaveClientUseCase $save
     */
    public function __construct(GetClientUseCase $get, SaveClientUseCase $save)
    {
        $this->get = $get;
        $this->save = $save;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $client = $this->get->__invoke($request->id);
        $this->authorize('owner', $client);

        $this->save->__invoke($request);

        return redirect()
            ->route('admin.clients')
            ->with('update', 'The client has been updated successfully.');
    }

}
