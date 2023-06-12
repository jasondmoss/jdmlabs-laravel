<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Application\UseCases\GetClientUseCase;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller {

    protected GetClientUseCase $get;


    /**
     * @param \App\Client\Application\UseCases\GetClientUseCase $get
     */
    public function __construct(GetClientUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $client = $this->get->__invoke($id);
//        $client->projects = Project::get()->pluck('title', 'id');

        $this->authorize('owner', $client);

        return ViewFacade::make('ClientAdmin::edit', [
            'client' => $client
        ]);
    }

}
