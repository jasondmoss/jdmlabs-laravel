<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Application\UseCases\StoreUseCase;
use Aenginus\Project\Infrastructure\Entities\ProjectEntity;
use Aenginus\Project\Interface\Web\Requests\CreateRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $usecase;


    /**
     * @param \Aenginus\Project\Application\UseCases\StoreUseCase $usecase
     */
    public function __construct(StoreUseCase $usecase) {
        $this->usecase = $usecase;
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

        return redirect()
            ->action(IndexController::class)
            ->with('create', 'Project created successfully.');
    }

}
