<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use App\Project\Application\UseCases\DestroyUseCase;
use App\Project\Infrastructure\Project;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected Project $project;

    protected DestroyUseCase $bridge;


    /**
     * @param \App\Project\Infrastructure\Project $project
     * @param \App\Project\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(Project $project, DestroyUseCase $bridge)
    {
        $this->project = $project;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->project->find((new Id($id))->value());

        $this->bridge->delete($toBeDeleted);

        return redirect()->action(IndexController::class);
    }

}
