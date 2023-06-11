<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\DeleteProjectUseCase;
use App\Project\Application\UseCases\GetProjectUseCase;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;

class ProjectAdminDestroyController extends Controller {

    protected DeleteProjectUseCase $deleteProject;

    protected GetProjectUseCase $getProject;


    /**
     * @param \App\Project\Application\UseCases\DeleteProjectUseCase $deleteProject
     * @param \App\Project\Application\UseCases\GetProjectUseCase $getProject
     */
    public function __construct(
        DeleteProjectUseCase $deleteProject,
        GetProjectUseCase $getProject
    ) {
        $this->deleteProject = $deleteProject;
        $this->getProject = $getProject;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $id): RedirectResponse
    {
        $project = $this->getProject->__invoke((new Id($id))->value());
        $this->authorize('create', $project);

        $this->deleteProject->__invoke($id);

        return redirect()
            ->route('admin.projects')
            ->with('delete', 'The project has been successfully deleted.');
    }

}
