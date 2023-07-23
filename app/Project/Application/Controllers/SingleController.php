<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Infrastructure\Project;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class SingleController extends Controller
{

    private Project $project;


    /**
     * @param \App\Project\Infrastructure\Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(string $key): View
    {
        $project = $this->project->find($key);

        return ViewFacade::make('ProjectPublic::single', [
            'project' => $project
        ]);
    }

}
