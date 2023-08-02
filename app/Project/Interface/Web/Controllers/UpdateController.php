<?php

declare(strict_types=1);

namespace App\Project\Interface\Web\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use App\Media\Infrastructure\Entities\ImageEntity;
use App\Project\Application\UseCases\UpdateUseCase as ProjectUseCase;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Project\Infrastructure\Entities\ProjectEntity;
use App\Project\Interface\Web\Requests\UpdateRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ProjectEloquentModel $project;

    protected ProjectUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     * @param \App\Project\Application\UseCases\UpdateUseCase $bridge
     * @param \App\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(
        ProjectEloquentModel $project,
        ProjectUseCase $bridge,
        MediaUseCase $media
    ) {
        $this->project = $project;
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \App\Project\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $projectEntity = new ProjectEntity($validated);

        $projectInstance = $this->project->find($projectEntity->id);

        $project = $this->bridge->update($projectInstance, $projectEntity);

        if ($request->hasFile('signature')) {
            $imageEntity = new ImageEntity((object) $request->signature);

            // Attach uploaded signature image.
            $this->media->attach($project, $imageEntity, 'signatures');
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Project updated successfully');
    }

}
