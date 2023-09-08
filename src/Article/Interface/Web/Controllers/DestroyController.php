<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Application\UseCases\DestroyUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected DestroyUseCase $bridge;


    /**
     * @param \Aenginus\Article\Application\UseCases\DestroyUseCase $bridge
     */
    public function __construct(DestroyUseCase $bridge)
    {
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     */
    public function __invoke(string $id): RedirectResponse
    {
        $this->bridge->delete($id);

        return redirect()
            ->action(IndexController::class)
            ->with('delete', 'Article successfully deleted.');
    }

}
