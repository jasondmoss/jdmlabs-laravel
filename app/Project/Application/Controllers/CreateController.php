<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Client\Infrastructure\Client;
use App\Laravel\Application\Controller;
use App\Project\Infrastructure\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller {

    public function __construct() {}


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $project = new Project();

        $project->clients = Client::get()->pluck('name', 'id');
//        $project->categories = Category::get()->pluck('name', 'id');

        return ViewFacade::make('ProjectAdmin::create', [
            'project' => $project
        ]);
    }

}
