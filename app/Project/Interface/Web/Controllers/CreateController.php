<?php

declare(strict_types=1);

namespace App\Project\Interface\Web\Controllers;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\Laravel\Application\Controller;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = ClientEloquentModel::get()->pluck('name', 'id');

        $categories = CategoryEloquentModel::get()->pluck('name', 'id');

        return ViewFacade::make('ProjectAdmin::create', [
            'clients' => $clients,
            'categories' => $categories
        ]);
    }

}
