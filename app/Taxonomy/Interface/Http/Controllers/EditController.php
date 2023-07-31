<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface\Http\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected CategoryEloquentModel $category;


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     */
    public function __construct(CategoryEloquentModel $category)
    {
        $this->category = $category;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $category = $this->category
            ->with('articles')
            ->find((new Id($id))->value());

        return ViewFacade::make('CategoryEloquentModel::edit', [
            'category' => $category
        ]);
    }

}
