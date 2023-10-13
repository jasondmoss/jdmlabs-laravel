<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Domain\Models\ProjectModel;
use App\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class SingleController extends Controller
{
    private ProjectModel $project;


    /**
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     */
    public function __construct(ProjectModel $project)
    {
        $this->project = $project;
    }


    /**
     * @param string $client
     * @param string $key
     *
     * @return \Illuminate\View\View
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $client, string $key): View
    {
        $project = $this->project->find($key);

        return ViewFacade::make('ProjectPublic::single', compact('project'));
    }
}
