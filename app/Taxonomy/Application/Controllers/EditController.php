<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use App\Taxonomy\Infrastructure\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected Category $category;


    /**
     * @param \App\Taxonomy\Infrastructure\Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(string $id): View
    {
        $category = $this->category->find((new Id($id))->value());

        return ViewFacade::make('Category::edit', [
            'category' => $category
        ]);
    }

}
