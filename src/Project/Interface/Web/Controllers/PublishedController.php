<?php

declare(strict_types=1);

namespace Aenginus\Project\Interface\Web\Controllers;

use Aenginus\Project\Domain\Models\ProjectModel;
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
        $projects = ProjectModel::published()->orderBy('created_at', 'desc')->with('clients')->get()->each(
                static function ($project) {
                    $project->entityDates();
                    $project->generatePermalink('project');
                }
            );

        return ViewFacade::make('ProjectPublic::list', compact('projects'));
    }

}
