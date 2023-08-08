<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\MultiImageUseCase;
use Aenginus\Media\Application\UseCases\SingleImageUseCase;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Aenginus\Project\Application\UseCases\StoreUseCase;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

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

        /**
         * Signature image (single).
         */
        if ($request->hasFile('signature_image')) {
            $this->signature->attach(
                $project,
                (object) $request->file('signature_image'),
                'signature'
            );
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
            ->action(IndexController::class)
            ->with('create', 'Project created successfully.');
    }

}
