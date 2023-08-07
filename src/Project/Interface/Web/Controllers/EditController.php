<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\ValueObjects\Id;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use App\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class EditController extends Controller
{

    protected ProjectEloquentModel $project;


    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     */
    public function __construct(ProjectEloquentModel $project)
    {
        $this->project = $project;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\View\View
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotFindProject
     */
    public function __invoke(string $id): View
    {
        $project = $this->project->find((new Id($id))->value());

        $project->generatePermalink();

        $clients = ClientEloquentModel::get()->pluck('name', 'id');
        $categories = CategoryEloquentModel::get()->pluck('name', 'id');

        $signature = $project->getFirstMedia('signatures');

        return ViewFacade::make(
            'ProjectAdmin::edit',
            compact('project', 'clients', 'categories', 'signature')
        );
    }

}
