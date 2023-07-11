<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\SaveProjectUseCase;
use App\Project\Infrastructure\Project;
use App\Project\Interface\ProjectFormRequest;
use Illuminate\Http\RedirectResponse;


class StoreController extends Controller
{

    protected SaveProjectUseCase $saveProject;


    /**
     * @param \App\Project\Application\UseCases\SaveProjectUseCase $saveProject
     */
    public function __construct(SaveProjectUseCase $saveProject)
    {
        $this->saveProject = $saveProject;
    }


    /**
     * @param \App\Project\Interface\ProjectFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ProjectFormRequest $request): RedirectResponse
    {
        $this->authorize('create', Project::class);

        // Store + return project.
        $project = $this->saveProject->__invoke($request);

        // Save + attach categories.
//        $project->categories()->sync((array) $request->input('categories'));


        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $project, 'signatures');

        return redirect()->action(IndexController::class);
    }

}
