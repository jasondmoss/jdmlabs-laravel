<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\GetProjectUseCase;
use App\Project\Application\UseCases\SaveProjectUseCase;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;


class ProjectAdminUpdateController extends Controller {

    protected GetProjectUseCase $get;

    protected SaveProjectUseCase $update;


    /**
     * @param \App\Project\Application\UseCases\GetProjectUseCase $get
     * @param \App\Project\Application\UseCases\SaveProjectUseCase $update
     */
    public function __construct(
        GetProjectUseCase $get,
        SaveProjectUseCase $update
    )
    {
        $this->get = $get;
        $this->update = $update;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $project = $this->get->__invoke($request->id);
        $this->authorize('owner', $project);

        // Update + return project.
        $project = $this->update->__invoke($request);

        // Save + attach categories.
//        $project->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $project, 'signatures');

        return redirect()
            ->route('admin.projects')
            ->with('update', 'The project has been updated successfully.');
    }

}
