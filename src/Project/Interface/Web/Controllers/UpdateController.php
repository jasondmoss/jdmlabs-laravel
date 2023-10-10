<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\StoreSingleImageUseCase;
use Aenginus\Project\Application\UseCases\UpdateUseCase as ProjectUseCase;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\UpdateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ProjectModel $project;

    protected ProjectUseCase $projectUseCase;

    protected StoreSingleImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     * @param \Aenginus\Project\Application\UseCases\UpdateUseCase $projectUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreSingleImageUseCase $imageUseCase
     */
    public function __construct(
        ProjectModel $project,
        ProjectUseCase $projectUseCase,
        StoreSingleImageUseCase $imageUseCase
    ) {
        $this->project = $project;
        $this->projectUseCase = $projectUseCase;
        $this->imageUseCase = $imageUseCase;
    }


    /**
     * @param \Aenginus\Project\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     * @throws \ReflectionException
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object)$request->validated();
        $projectEntity = new ProjectEntity($validated);
        $projectInstance = $this->project->find($projectEntity->id);
        $project = $this->projectUseCase->update($projectInstance, $projectEntity);

        $requestImages = [];

        // Signature image.
        if ($request->file('signature_image') !== null) {
            foreach ($request->signature_image as $signature_image) {
                $requestImages[] = (object) $signature_image;
            }
        }

        // Showcase images.
        if ($request->file('showcase_images') !== null) {
            foreach ($request->showcase_images as $showcase_images) {
                $requestImages[] = (object) $showcase_images;
            }
        }

        $this->imageUseCase->store($project, $requestImages);

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Project updated successfully');
    }

}
