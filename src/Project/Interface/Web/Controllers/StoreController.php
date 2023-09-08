<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\MultiImageUseCase;
use Aenginus\Media\Application\UseCases\SingleImageUseCase;
use Aenginus\Project\Application\UseCases\StoreUseCase;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $usecase;
    protected SingleImageUseCase $signature;
    protected MultiImageUseCase $showcase;


    /**
     * @param \Aenginus\Project\Application\UseCases\StoreUseCase $usecase
     * @param \Aenginus\Media\Application\UseCases\SingleImageUseCase $signature
     * @param \Aenginus\Media\Application\UseCases\MultiImageUseCase $showcase
     */
    public function __construct(
        StoreUseCase $usecase,
        SingleImageUseCase $signature,
        MultiImageUseCase $showcase
    ) {
        $this->usecase = $usecase;
        $this->signature = $signature;
        $this->showcase = $showcase;
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
        $project = $this->usecase->store($projectEntity);

        // Signature image (single).
        if ($request->hasFile('signature_image')) {
            $this->signature->attach(
                $project,
                (object) $request->signature_image,
                'signature'
            );
        }

        // Showcase images (multiple).
        if ($request->file('showcase_images') !== null) {
            $this->showcase->attach(
                $project,
                $request->showcase_images,
                'showcase'
            );
        }

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Project created successfully.');
    }

}
