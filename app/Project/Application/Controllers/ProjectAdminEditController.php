<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Client\Infrastructure\Client;
use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetProjectUseCase;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class ProjectAdminEditController extends Controller {

    protected GetProjectUseCase $getProject;


    /**
     * @param \App\Project\Application\UseCases\GetProjectUseCase $getProject
     */
    public function __construct(GetProjectUseCase $getProject)
    {
        $this->getProject = $getProject;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(string $id): View
    {
        $project = $this->getProject->__invoke((new Id($id))->value());

//        $project->categories = Category::get()->pluck('name', 'id');

        $project->clients = Client::get()->pluck('name', 'id');

        $this->authorize('owner', $project);

        return ViewFacade::make('ProjectAdmin::edit', [
            'project' => $project
        ]);
    }

}
