<?php

declare(strict_types=1);

namespace App\Article\Application\Controllers;

use App\Article\Application\UseCases\StoreUseCase;
use App\Article\Interface\Http\CreateRequest;
use App\Core\Laravel\Application\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{

    protected StoreUseCase $conjoins;


    /**
     * @param \App\Article\Application\UseCases\StoreUseCase $conjoins
     */
    public function __construct(StoreUseCase $conjoins)
    {
        $this->conjoins = $conjoins;
    }


    /**
     * @param \App\Article\Interface\Http\CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        // Store + return article.
        $article = $this->conjoins->store($request);

        // Save + attach signature image.
//        $this->saveSignature->__invoke($request->image, $article, 'signatures');

        return redirect()->action(IndexController::class);
    }

}
