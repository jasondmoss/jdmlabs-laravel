<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use App\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class SingleController extends Controller
{

    private ProjectEloquentModel $project;


    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     */
    public function __construct(ProjectEloquentModel $project)
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

        $signature = $project->getFirstMedia('signature');
        $showcase = $project->getMedia('showcase');

        return ViewFacade::make(
            'ProjectPublic::single',
            compact('project', 'signature', 'showcase')
        );
    }

}
