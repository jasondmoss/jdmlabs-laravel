<?php

declare(strict_types=1);

namespace App\Project\Interface\Http\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Media\Application\UseCases\AttachUseCase as MediaUseCase;
use App\Media\Infrastructure\Entities\ImageEntity;
use App\Project\Application\UseCases\StoreUseCase;
use App\Project\Infrastructure\Entities\ProjectEntity;
use App\Project\Interface\Http\Requests\CreateRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;

    protected MediaUseCase $media;


    /**
     * @param \App\Project\Application\UseCases\StoreUseCase $bridge
     * @param \App\Media\Application\UseCases\AttachUseCase $media
     */
    public function __construct(StoreUseCase $bridge, MediaUseCase $media)
    {
        $this->bridge = $bridge;
        $this->media = $media;
    }


    /**
     * @param \App\Project\Interface\Http\Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();

        // Create a new validated article entity.
        $projectEntity = new ProjectEntity($validated);

        // Store + return article.
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
