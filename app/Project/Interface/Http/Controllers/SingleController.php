<?php

declare(strict_types=1);

namespace App\Project\Interface\Http\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class SingleController extends Controller
{

    private ProjectEloquentModel $project;


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     */
    public function __construct(ProjectEloquentModel $project)
    {
        $this->project = $project;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\View\View
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     */
    public function __invoke(string $key): View
    {
        $project = $this->project->find($key);

        $signature = $project->getFirstMedia('signatures');

        return ViewFacade::make('ProjectPublic::single', [
            'project' => $project,
            'signature' => $signature
        ]);
    }

}
