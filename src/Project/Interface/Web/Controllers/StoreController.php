<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\StoreSingleImageUseCase;
use Aenginus\Project\Application\UseCases\StoreUseCase as ProjectStoreCase;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected ProjectStoreCase $projectUseCase;

    protected StoreSingleImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Project\Application\UseCases\StoreUseCase $projectUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreSingleImageUseCase $imageUseCase
     */
    public function __construct(
        ProjectStoreCase $projectUseCase,
        StoreSingleImageUseCase $imageUseCase
    ) {
        $this->projectUseCase = $projectUseCase;
        $this->imageUseCase = $imageUseCase;
    }


    /**
     * @param \Aenginus\Project\Interface\Web\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \ReflectionException
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object)$request->validated();
        $projectEntity = new ProjectEntity($validated);
        $project = $this->projectUseCase->store($projectEntity);

        // Signature image (single).
        if ($request->hasFile('signature_image')) {
            $this->imageUseCase->store($project, (object) $request->signature_image);
        }

        // Showcase images (multiple).
        /*$requestImages = [];
        if ($request->file('showcase_images') !== null) {
            foreach ($request->showcase_images as $showcase_image) {
                $requestImages[] = (object) $showcase_image;
            }

            $this->imageUseCase->store($project, $requestImages);
        }*/


        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Project created successfully.');
    }

}
