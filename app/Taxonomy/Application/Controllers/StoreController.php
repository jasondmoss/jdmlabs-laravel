<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Application\UseCases\StoreUseCase;
use App\Taxonomy\Interface\Http\CategoryRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $bridge;


    /**
     * @param \App\Taxonomy\Application\UseCases\StoreUseCase $bridge
     */
    public function __construct(StoreUseCase $bridge)
    {
        $this->bridge = $bridge;
    }


    /**
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        $this->bridge->store($request);

        return redirect()->action(IndexController::class);
    }

}
