<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Project\Domain\Model\ProjectModel;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use App\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class EditController extends Controller
{

    protected ProjectModel $project;


    /**
     * @param \Aenginus\Project\Domain\Model\ProjectModel $project
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

        $signature = $project->getFirstMedia('signature');
        $showcase_images = $project->getMedia('showcase');

        $clients = ClientEloquentModel::get()->pluck('name', 'id');
        $categories = CategoryEloquentModel::get()->pluck('name', 'id');

        return ViewFacade::make(
            'ProjectAdmin::edit',
            compact(
                'project',
                'clients',
                'categories',
                'signature',
                'showcase_images'
            )
        );
    }

}
