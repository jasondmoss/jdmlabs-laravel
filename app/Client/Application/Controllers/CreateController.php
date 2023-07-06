<?php

declare(strict_types=1);

namespace App\Client\Application\Controllers;

use App\Client\Infrastructure\ClientModel;
use App\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

//use App\ProjectModel\Infrastructure\ProjectModel;

class CreateController extends Controller {

    protected ClientModel $client;


    public function __construct() {}


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $client = new ClientModel;
//        $client->projects = ProjectModel::get()->pluck('title', 'id');

        return ViewFacade::make('ClientAdmin::create', [
            'client' => $client
        ]);
    }

}
