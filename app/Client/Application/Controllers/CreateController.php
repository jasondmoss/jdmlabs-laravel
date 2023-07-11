<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Infrastructure\Client;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller
{

    protected Client $client;


    public function __construct() {}


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $client = new Client;

        return ViewFacade::make('ClientAdmin::create', [
            'client' => $client
        ]);
    }

}
