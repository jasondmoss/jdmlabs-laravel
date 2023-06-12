<?php

declare(strict_types=1);

namespace App\Project\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Project\Application\UseCases\DeleteProjectUseCase;
use App\Project\Application\UseCases\GetProjectUseCase;
use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller {

    protected GetProjectUseCase $get;

    protected DeleteProjectUseCase $delete;


    /**
     * @param \App\Project\Application\UseCases\GetProjectUseCase $get
     * @param \App\Project\Application\UseCases\DeleteProjectUseCase $delete
     */
    public function __construct(GetProjectUseCase $get, DeleteProjectUseCase $delete)
    {
        $this->get = $get;
        $this->delete = $delete;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $id): RedirectResponse
    {
        $project = $this->get->__invoke((new Id($id))->value());
        $this->authorize('create', $project);

        $this->delete->__invoke($id);

        return redirect()
            ->route('admin.projects')
            ->with('delete', 'The project has been successfully deleted.');
    }

}
