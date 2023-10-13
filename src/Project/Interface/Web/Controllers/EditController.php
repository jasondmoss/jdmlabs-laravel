<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use App\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class EditController extends Controller
{

    protected ProjectModel $project;


    /**
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     */
    public function __construct(ProjectModel $project)
    {
        $this->project = $project;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\View\View
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $id): View
    {
        $project = $this->project->find((new UlidValueObject($id))->value());
        $project->entityDates();
        $project->generatePermalink();

        $clients = ClientModel::get()->pluck('name', 'id');
        $categories = CategoryModel::get()->pluck('name', 'id');

        return ViewFacade::make(
            'ProjectAdmin::edit', compact(
                'project', 'clients', 'categories'
            )
        );
    }

}
