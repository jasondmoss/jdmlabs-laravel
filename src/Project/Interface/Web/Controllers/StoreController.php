<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\StoreImageUseCase;
use Aenginus\Project\Application\UseCases\StoreUseCase as ProjectStoreCase;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    protected ProjectStoreCase $projectUseCase;

    protected StoreImageUseCase $imageUseCase;


    /**
     * @param \Aenginus\Project\Application\UseCases\StoreUseCase $projectUseCase
     * @param \Aenginus\Media\Application\UseCases\StoreImageUseCase $imageUseCase
     */
    public function __construct(
        ProjectStoreCase $projectUseCase,
        StoreImageUseCase $imageUseCase
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
        $validated = (object) $request->validated();
        $projectEntity = new ProjectEntity($validated);
        $project = $this->projectUseCase->store($projectEntity);

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
            ->action(IndexController::class)
            ->with('create', 'Project created successfully.');
    }
}
