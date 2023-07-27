<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Client\Infrastructure\Client;
use App\Core\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = Client::get()->pluck('name', 'id');

//        $categories = Category::get()->pluck('name', 'id');

        return ViewFacade::make('ProjectAdmin::create', [
            'clients' => $clients,
            /*'categories' => $categories*/
        ]);
    }

}
