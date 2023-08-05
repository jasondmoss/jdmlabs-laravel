<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class SingleController extends Controller
{

    private ProjectEloquentModel $project;


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     */
    public function __construct(ProjectEloquentModel $project)
    {
        $this->project = $project;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\View\View
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotFindProject
     */
    public function __invoke(string $key): View
    {
        $project = $this->project->find($key);

        $signature = $project->getFirstMedia('signatures');

        return ViewFacade::make(
            'ProjectPublic::single',
            compact('project', 'signature')
        );
    }

}
