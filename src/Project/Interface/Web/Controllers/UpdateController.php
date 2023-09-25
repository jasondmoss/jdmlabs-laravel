<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

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


    /**
     * @param \Aenginus\Project\Domain\Models\ProjectModel $project
     * @param \Aenginus\Project\Application\UseCases\UpdateUseCase $bridge
     */
    public function __construct(
        ProjectModel $project,
        ProjectUseCase $bridge
    ) {
        $this->project = $project;
        $this->bridge = $bridge;
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

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Project updated successfully');
    }

}
