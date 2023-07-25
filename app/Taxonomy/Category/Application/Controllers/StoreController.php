<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Controllers;

use App\Laravel\Application\Controller;
use App\Taxonomy\Category\Application\UseCases\StoreUseCase;
use App\Taxonomy\Category\Interface\Http\CategoryRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $conjoins;


    /**
     * @param \App\Taxonomy\Category\Application\UseCases\StoreUseCase $conjoins
     */
    public function __construct(StoreUseCase $conjoins)
    {
        $this->conjoins = $conjoins;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\Http\CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        $this->conjoins->store($request);

        return redirect()->action(IndexController::class);
    }

}
