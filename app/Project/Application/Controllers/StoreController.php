<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\StoreUseCase;
use App\Project\Infrastructure\Project;
use App\Project\Interface\Requests\Http\CreateRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $saveProject;


    /**
     * @param \App\Project\Application\UseCases\StoreUseCase $saveProject
     */
    public function __construct(StoreUseCase $saveProject)
    {
        $this->saveProject = $saveProject;
    }


    /**
     * @param \App\Project\Interface\Requests\Http\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $this->authorize('create', Project::class);

        // Store + return project.
        $project = $this->saveProject->store($request);

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $project, 'signatures');

        return redirect()->action(IndexController::class);
    }

}
