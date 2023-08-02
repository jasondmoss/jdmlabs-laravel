<?php

declare(strict_types=1);

namespace App\Project\Interface\Http\Web\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use App\Project\Application\Exceptions\CouldNotDeleteProject;
use App\Project\Application\UseCases\DestroyUseCase;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Exception;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected ProjectEloquentModel $project;

    protected DestroyUseCase $bridge;


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     * @param \App\Project\Application\UseCases\DestroyUseCase $bridge
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
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     * @throws \App\Project\Application\Exceptions\CouldNotDeleteProject
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
