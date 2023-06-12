<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetPublishedProjectsUseCase;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ProjectPublicPublishedController extends Controller {

    private GetPublishedProjectsUseCase $get;


    /**
     * @param \App\Project\Application\UseCases\GetPublishedProjectsUseCase $get
     */
    public function __construct(GetPublishedProjectsUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $projects = $this->get->__invoke();

        return ViewFacade::make('ProjectPublic::show', [
            'projects' => $projects
        ]);
    }

}
