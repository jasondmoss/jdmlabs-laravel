<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Client\Infrastructure\Client;
use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetProjectUseCase;
use App\Shared\ValueObjects\Id;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class EditController extends Controller
{

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
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $id): View
    {
        $project = $this->getProject->__invoke((new Id($id))->value());
        $this->authorize('owner', $project);

        $project->clients = Client::get()->pluck('name', 'id');

        return ViewFacade::make('ProjectAdmin::edit', [
            'project' => $project
        ]);
    }

}
