<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Application\Exceptions\CouldNotDeleteProject;
use Aenginus\Project\Application\UseCases\DestroyUseCase;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Project\Infrastructure\ValueObjects\Id;
use App\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected ProjectEloquentModel $project;

    protected DestroyUseCase $bridge;


    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     * @param \Aenginus\Project\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(ProjectEloquentModel $project, DestroyUseCase $bridge)
    {
        $this->project = $project;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotFindProject
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotDeleteProject
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->project->find((new Id($id))->value());

        try {
            $this->bridge->delete($toBeDeleted);
        } catch (Exception $exception) {
            throw CouldNotDeleteProject::withId($toBeDeleted->id);
        }

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Project successfully deleted.');
    }

}
