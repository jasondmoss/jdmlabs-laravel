<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $projects = ProjectEloquentModel::published()
            ->orderBy('created_at', 'desc')
            ->with('clients')
            ->get()
            ->each(static function ($project) {
                $project->generateDates();
                $project->generatePermalink();
            });

        return ViewFacade::make('ProjectPublic::list', compact('projects'));
    }

}
