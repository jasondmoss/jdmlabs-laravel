<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Aenginus\Project\Application\UseCases\StoreUseCase;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \Aenginus\Project\Application\UseCases\StoreUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(StoreUseCase $bridge, MediaUseCase $media)
    {
        $this->bridge = $bridge;
        $this->media = $media;
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

        $project = $this->bridge->store($projectEntity);

        if ($request->hasFile('signature_image')) {
            $imageEntity = new ImageEntity((object) $request->signature_image);

            // Attach uploaded signature image.
            $this->media->attach($project, $imageEntity, 'signatures');
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Project created successfully.');
    }

}
