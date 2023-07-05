<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetProjectUseCase;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class SingleController extends Controller {

    private GetProjectUseCase $getProject;


    /**
     * @param \App\Project\Application\UseCases\GetProjectUseCase $getProject
     */
    public function __construct(GetProjectUseCase $getProject)
    {
        $this->getProject = $getProject;
    }


    /**
     * @param $project
     *
     * @return \Illuminate\View\View
     */
    public function __invoke($project): View
    {
        $project = $this->getProject->__invoke($project);
//        $project->categories = $project->categories()->get();

        return ViewFacade::make('ProjectPublic::single', [
            'project' => $project
        ]);
    }

}
