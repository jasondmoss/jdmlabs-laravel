<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase as MediaUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Aenginus\Project\Application\UseCases\UpdateUseCase as ProjectUseCase;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\UpdateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class UpdateController extends Controller
{

    protected ProjectEloquentModel $project;

    protected ProjectUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     * @param \Aenginus\Project\Application\UseCases\UpdateUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase $media
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
     * @param \Aenginus\Project\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotFindProject
     * @throws \ReflectionException
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $projectEntity = new ProjectEntity($validated);

        $projectInstance = $this->project->find($projectEntity->id);

        $project = $this->bridge->update($projectInstance, $projectEntity);

        if ($request->hasFile('signature_image')) {
            $signatureImage = $request->file('signature_image');

            if ($signatureImage['file']->isValid()) {
                $imageEntity = new ImageEntity((object) $request->signature_image);

                // Attach uploaded signature image.
                $this->media->attach($project, $imageEntity, 'signatures');
            } else {
                throw new RuntimeException('Signature image is invalid');
            }
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Project updated successfully');
    }

}
