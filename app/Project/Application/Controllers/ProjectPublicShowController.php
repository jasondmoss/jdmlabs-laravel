<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetProjectUseCase;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class ProjectPublicShowController extends Controller {

    private GetProjectUseCase $get;


    /**
     * @param \App\Project\Application\UseCases\GetProjectUseCase $get
     */
    public function __construct(GetProjectUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @param $project
     *
     * @return \Illuminate\View\View
     */
    public function __invoke($project): View
    {
        $project = $this->get->__invoke($project);
//        $project->categories = $project->categories()->get();

        return ViewFacade::make('ProjectPublic::single', [
            'project' => $project
        ]);
    }

}
