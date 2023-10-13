<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\DestroyUseCase;
use Aenginus\Article\Interface\Web\Requests\DestroyRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{
    protected DestroyUseCase $articleUseCase;


    /**
     * @param \Aenginus\Article\Application\UseCases\DestroyUseCase $articleUseCase
     */
    public function __construct(DestroyUseCase $articleUseCase)
    {
        $this->articleUseCase = $articleUseCase;
    }


    /**
     * @param \Aenginus\Article\Interface\Web\Requests\DestroyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(DestroyRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();

        $this->articleUseCase->delete($validated->id);

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Article successfully deleted.');
    }
}
