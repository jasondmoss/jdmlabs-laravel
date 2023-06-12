<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\SaveProjectUseCase;
use App\Project\Infrastructure\Project;
use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;


class ProjectAdminStoreController extends Controller {

    protected SaveProjectUseCase $save;


    /**
     * @param \App\Project\Application\UseCases\SaveProjectUseCase $save
     */
    public function __construct(SaveProjectUseCase $save)
    {
        $this->save = $save;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $this->authorize('create', Project::class);

        // Store + return project.
        $project = $this->save->__invoke($request);

        // Save + attach categories.
//        $project->categories()->sync((array) $request->input('categories'));

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $project, 'signatures');

        return redirect()
            ->route('admin.projects')
            ->with('create', 'The project has been successfully saved.');
    }

}