<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Project\Application\UseCases\UpdateUseCase;
use App\Project\Infrastructure\Project;
use App\Project\Interface\Http\UpdateRequest;
use Illuminate\Http\RedirectResponse;


class UpdateController extends Controller
{

    protected Project $project;

    protected UpdateUseCase $bridge;


    /**
     * @param \App\Project\Infrastructure\Project $project
     * @param \App\Project\Application\UseCases\UpdateUseCase $bridge
     */
    public function __construct(Project $project, UpdateUseCase $bridge)
    {
        $this->project = $project;
        $this->bridge = $bridge;
    }


    /**
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        // Update + return project.
        $project = $this->bridge->update($request);

        // Save + attach signature image.
//        $this->saveImage->__invoke($request->image, $project, 'signatures');

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Project successfully updated');
    }

}
