<?php

declare(strict_types=1);

namespace App\Project\Domain;

use App\Project\Infrastructure\Project;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

final readonly class ProjectObserver
{

    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return void
     */
    public function creating(Project $project): void
    {
        if (! App::runningInConsole()) {
            $project->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return void
     */
    public function created(Project $project): void {}


    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return void
     */
    public function deleting(Project $project): void {}


    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return void
     */
    public function deleted(Project $project): void {}


    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return void
     */
    public function updating(Project $project): void
    {
        $project->slug = Str::of($project->title)->slug('-');
    }


    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return void
     */
    public function updated(Project $project): void {}
}
