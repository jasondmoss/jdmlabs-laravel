<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Interface\Web\Controllers;

use Aenginus\Taxonomy\Application\UseCases\DestroyUseCase;
use Aenginus\Taxonomy\Interface\Web\Requests\DestroyRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected DestroyUseCase $bridge;


    /**
     * @param \Aenginus\Taxonomy\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(DestroyUseCase $bridge)
    {
        $this->bridge = $bridge;
    }


    /**
     * @param \Aenginus\Taxonomy\Interface\Web\Requests\DestroyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(DestroyRequest $request): RedirectResponse
    {
        $validated = (object)$request->validated();

        $this->bridge->delete($validated->id);

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Category successfully deleted.');
    }

}
