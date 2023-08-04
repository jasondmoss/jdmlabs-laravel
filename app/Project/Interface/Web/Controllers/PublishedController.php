<?php

declare(strict_types=1);

namespace App\Project\Interface\Web\Controllers;

use App\Core\Laravel\Application\Controller;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
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
            ->get()
            ->each(fn ($project) => $project->generatePermalink());

        /**
         * Generate a 'permalink' for each article.
         */
        $projects->each(
            fn ($project): string => $project->permalink = url("/project/$project->slug")
        );

        return ViewFacade::make('ProjectPublic::list', [
            'projects' => $projects
        ]);
    }

}
