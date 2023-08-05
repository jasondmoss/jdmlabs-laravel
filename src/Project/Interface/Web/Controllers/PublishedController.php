<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
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
            ->get()
            ->each(static fn ($project) => $project->generatePermalink());

        /**
         * Generate a 'permalink' for each article.
         */
        $projects->each(
            static fn ($project): string => $project->permalink = url(
                "/project/$project->slug"
            )
        );

        return ViewFacade::make('ProjectPublic::list', compact('projects'));
    }

}
