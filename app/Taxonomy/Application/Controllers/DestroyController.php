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

    protected DestroyUseCase $conjoins;


    public function __construct(Category $category, DestroyUseCase $conjoins)
    {
        $this->category = $category;
        $this->conjoins = $conjoins;
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

        $this->conjoins->delete($toBeDeleted);

        return redirect()->action(IndexController::class);
    }

}
