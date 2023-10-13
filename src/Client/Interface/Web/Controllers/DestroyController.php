<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\DestroyUseCase;
use Aenginus\Client\Interface\Web\Requests\DestroyRequest;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected DestroyUseCase $ClientUseCase;


    /**
     * @param \Aenginus\Client\Application\UseCases\DestroyUseCase $ClientUseCase
     */
    public function __construct(DestroyUseCase $ClientUseCase)
    {
        $this->ClientUseCase = $ClientUseCase;
    }


    /**
     * @param \Aenginus\Client\Interface\Web\Requests\DestroyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(DestroyRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();

        $this->ClientUseCase->delete($validated->id);

        return redirect()->action(IndexController::class)->with('delete', 'Client successfully deleted.');
    }

}
