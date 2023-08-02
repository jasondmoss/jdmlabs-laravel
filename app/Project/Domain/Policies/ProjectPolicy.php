<?php

declare(strict_types=1);

namespace App\Project\Domain\Policies;

use App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Shared\Enums\Status;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ProjectPolicy
{

    use HandlesAuthorization;

    /**
     * @param \App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        return ($user->email === Config::get('jdmlabs.admin_email'))
            ? Response::allow()
            : Response::deny('You are not authorized to create a new project.');
    }


    /**
     * @param \App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(UserEloquentModel $user, ProjectEloquentModel $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this project.');
    }


    /**
     * @param \App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, ProjectEloquentModel $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to edit this project.');
    }


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(ProjectEloquentModel $project): Response
    {
        return Status::Published === $project->status
            ? Response::allow()
            : Response::deny('You do not have permission to view this project.');
    }

}
