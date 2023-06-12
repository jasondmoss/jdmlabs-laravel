<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\DeleteClientUseCase;
use App\Client\Application\UseCases\GetClientUseCase;
use App\Laravel\Application\Controller;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DestroyController extends Controller {

    protected GetClientUseCase $get;

    protected DeleteClientUseCase $delete;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $get
     * @param \App\Client\Application\UseCases\DeleteClientUseCase $delete
     */
    public function __construct(GetClientUseCase $get, DeleteClientUseCase $delete)
    {
        $this->get = $get;
        $this->delete = $delete;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $id): Redirector|RedirectResponse
    {
        $client = $this->get->__invoke((new Id($id))->value());
        $this->authorize('create', $client);

        $this->delete->__invoke($id);

        return redirect()
            ->route('admin.clients')
            ->with('delete', 'The client has been successfully deleted.');
    }

}
