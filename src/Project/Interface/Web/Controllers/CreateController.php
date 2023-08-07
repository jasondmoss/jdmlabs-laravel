<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use App\Controller;
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

        return ViewFacade::make(
            'ProjectAdmin::create',
            compact('clients', 'categories')
        );
    }

}
