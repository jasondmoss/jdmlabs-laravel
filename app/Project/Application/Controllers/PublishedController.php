<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetPublishedProjectsUseCase;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller {

    private GetPublishedProjectsUseCase $getProject;


    /**
     * @param \App\Project\Application\UseCases\GetPublishedProjectsUseCase $getProject
     */
    public function __construct(GetPublishedProjectsUseCase $getProject)
    {
        $this->getProject = $getProject;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $projects = $this->getProject->__invoke();

        return ViewFacade::make('ProjectPublic::show', [
            'projects' => $projects
        ]);
    }

}
