<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use App\Taxonomy\Application\UseCases\DestroyUseCase;
use App\Taxonomy\Infrastructure\Category;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{

    protected Category $category;

    protected DestroyUseCase $bridge;


    public function __construct(Category $category, DestroyUseCase $bridge)
    {
        $this->category = $category;
        $this->bridge = $bridge;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(string $id): RedirectResponse
    {
        $toBeDeleted = $this->category->find((new Id($id))->value());

        $this->bridge->delete($toBeDeleted);

        return redirect()->action(IndexController::class);
    }

}
