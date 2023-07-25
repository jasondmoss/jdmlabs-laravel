<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Client\Infrastructure\Client;
use App\Laravel\Application\Controller;
use App\Project\Infrastructure\Project;
use App\Shared\ValueObjects\Id;
use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class EditController extends Controller
{

    protected Project $project;


    /**
     */
    public function __construct(Project $project)
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

//        $categories = Category::get()->pluck('name', 'id');

        return ViewFacade::make('ProjectAdmin::edit', [
            'project' => $project,
            'clients' => $clients,
            /*'categories' => $categories*/
        ]);
    }

}
