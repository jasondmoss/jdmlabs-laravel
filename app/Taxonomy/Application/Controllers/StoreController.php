<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Application\UseCases\StoreUseCase;
use App\Taxonomy\Interface\Http\CategoryRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $conjoins;


    /**
     * @param \App\Taxonomy\Application\UseCases\StoreUseCase $conjoins
     */
    public function __construct(StoreUseCase $conjoins)
    {
        $this->conjoins = $conjoins;
    }


    /**
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        $this->conjoins->store($request);

        return redirect()->action(IndexController::class);
    }

}
