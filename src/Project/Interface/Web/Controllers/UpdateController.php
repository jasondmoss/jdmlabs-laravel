<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Media\Application\UseCases\MultiImageUseCase;
use Aenginus\Media\Application\UseCases\SingleImageUseCase;
use Aenginus\Project\Application\UseCases\UpdateUseCase as ProjectUseCase;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\UpdateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ProjectModel $project;
    protected ProjectUseCase $bridge;
    protected SingleImageUseCase $signature;
    protected MultiImageUseCase $showcase;


    /**
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     * @param \Aenginus\Project\Application\UseCases\UpdateUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\SingleImageUseCase $signature
     * @param \Aenginus\Media\Application\UseCases\MultiImageUseCase $showcase
     */
    public function __construct(
        ProjectModel $project,
        ProjectUseCase $bridge,
        SingleImageUseCase $signature,
        MultiImageUseCase $showcase
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
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     * @throws \ReflectionException
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $projectEntity = new ProjectEntity($validated);
        $projectInstance = $this->project->find($projectEntity->id);
        $project = $this->bridge->update($projectInstance, $projectEntity);

        // Signature image (single).
        /*if ($request->hasFile('signature_image')) {
            $this->signature->attach(
                $project,
                (object) $request->signature_image,
                'signature'
            );
        }*/

        // Showcase images (multiple).
        /*if ($request->file('showcase_images') !== null) {
            $this->showcase->attach(
                $project,
                $request->showcase_images,
                'showcase'
            );
        }*/

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Project updated successfully');
    }

}
