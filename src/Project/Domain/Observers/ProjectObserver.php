<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Observers;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Illuminate\Support\Facades\App;

final readonly class ProjectObserver
{

    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function creating(ProjectEloquentModel $project): void
    {
        if (! App::runningInConsole()) {
            $project->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function created(ProjectEloquentModel $project): void {}


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function deleting(ProjectEloquentModel $project): void {}


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function deleted(ProjectEloquentModel $project): void {}


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function updating(ProjectEloquentModel $project): void {}


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function updated(ProjectEloquentModel $project): void {}
}
