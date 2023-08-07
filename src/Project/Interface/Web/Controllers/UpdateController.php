<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\ProcessMedia;
use Aenginus\Media\Application\UseCases\AttachShowcaseImagesUseCase;
use Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Aenginus\Project\Application\UseCases\UpdateUseCase as ProjectUseCase;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\UpdateRequest;
use App\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class UpdateController extends Controller
{

    protected ProjectEloquentModel $project;

    protected ProjectUseCase $bridge;

    protected AttachSignatureImageUseCase $signature;

    protected AttachShowcaseImagesUseCase $showcase;


    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     * @param \Aenginus\Project\Application\UseCases\UpdateUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\AttachSignatureImageUseCase $signature
     * @param \Aenginus\Media\Application\UseCases\AttachShowcaseImagesUseCase $showcase
     */
    public function __construct(
        ProjectEloquentModel $project,
        ProjectUseCase $bridge,
        AttachSignatureImageUseCase $signature,
        AttachShowcaseImagesUseCase $showcase
    ) {
        $this->project = $project;
        $this->bridge = $bridge;
        $this->signature = $signature;
        $this->showcase = $showcase;
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

        /**
         * Signature image (single).
         */
        if ($request->hasFile('signature_image')) {
            $signatureImage = $request->file('signature_image');

            if ($signatureImage['file']->isValid()) {
                $imageEntity = new ImageEntity((object) $signatureImage);

                // Attach uploaded signature image.
                try {
                    $this->signature->attach($project, $imageEntity);
                } catch (Exception) {
                    throw new RuntimeException('Signature image could not  be saved.');
                }
            } else {
                throw new RuntimeException('Signature image is not valid.');
            }
        }

        /**
         * Showcase images (multiple).
         */
        if ($request->file('showcase_images') !== null) {
            $showcaseImages = [];

            foreach ($request->file('showcase_images') as $showcaseImage) {
                if ($showcaseImage['file']->isValid()) {
                    $imageEntity = new ImageEntity((object) $showcaseImage);

                    $showcaseImages[] = $imageEntity;
                } else {
                    throw new RuntimeException('Showcase image is not valid');
                }
            }

            try {
                // Attach uploaded showcase images as a whole.
                $this->showcase->attach($project, $showcaseImages, 'showcase');
            } catch (Exception) {
                throw new RuntimeException('Signature image could not  be saved.');
            }
        }

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Project updated successfully');
    }

}
