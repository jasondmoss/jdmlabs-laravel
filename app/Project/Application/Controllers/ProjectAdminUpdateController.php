<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetProjectUseCase;
use App\Project\Application\UseCases\SaveProjectUseCase;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;


class ProjectAdminUpdateController extends Controller {

    protected SaveProjectUseCase $updateProject;

    protected GetProjectUseCase $getProject;


    /**
     * @param \App\Project\Application\UseCases\GetProjectUseCase $getProject
     * @param \App\Project\Application\UseCases\SaveProjectUseCase $updateProject
     */
    public function __construct(
        GetProjectUseCase $getProject,
        SaveProjectUseCase $updateProject
    )
    {
        $this->getProject = $getProject;
        $this->updateProject = $updateProject;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $project = $this->getProject->__invoke($request->id);
        $this->authorize('owner', $project);

        // Update + return project.
        $project = $this->updateProject->__invoke($request);

        // Save + attach categories.
//        $project->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $project, 'signatures');

        return redirect()
            ->route('admin.projects')
            ->with('update', 'The project has been updated successfully.');
    }

}
