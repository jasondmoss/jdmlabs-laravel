<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Application\UseCases\DestroyUseCase;
use Aenginus\Project\Interface\Web\Requests\DestroyRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected DestroyUseCase $projectUseCase;


    /**
     * @param \Aenginus\Project\Application\UseCases\DestroyUseCase $projectUseCase
     */
    public function __construct(DestroyUseCase $projectUseCase)
    {
        $this->projectUseCase = $projectUseCase;
    }


    /**
     * @param \Aenginus\Project\Interface\Web\Requests\DestroyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(DestroyRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();

        $this->projectUseCase->delete($validated->id);

        return redirect()->action(IndexController::class)->with('delete', 'Project successfully deleted.');
    }

}
