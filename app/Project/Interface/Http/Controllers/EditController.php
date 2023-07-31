<?php

declare(strict_types=1);

namespace App\Project\Interface\Http\Controllers;

use App\Client\Infrastructure\Client;
use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class EditController extends Controller
{

    protected ProjectEloquentModel $project;


    /**
     */
    public function __construct(ProjectEloquentModel $project)
    {
        $this->project = $project;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\View\View
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     */
    public function __invoke(string $id): View
    {
        $project = $this->project->find((new Id($id))->value());

        $clients = Client::get()->pluck('name', 'id');
        $categories = CategoryEloquentModel::get()->pluck('name', 'id');

        $signature = $project->getFirstMedia('signatures');

        return ViewFacade::make('ProjectAdmin::edit', [
            'project' => $project,
            'clients' => $clients,
            'categories' => $categories,
            'signature' => $signature
        ]);
    }

}
