<?php

declare(strict_types=1);

namespace App\Project\Domain;

use App\Auth\Infrastructure\User;
use App\Project\Infrastructure\Project;
use App\Shared\Enums\Status;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ProjectPolicy
{

    use HandlesAuthorization;

    /**
     * @param \App\Auth\Infrastructure\User $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(User $user): Response
    {
        return ($user->email === Config::get('jdmlabs.admin_email'))
            ? Response::allow()
            : Response::deny('You are not authorized to create a new project.');
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(User $user, Project $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this project.');
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Project $project): Response
    {
        return $user->id === $project->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to edit this project.');
    }


    /**
     * @param \App\Project\Infrastructure\Project $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(Project $project): Response
    {
        return Status::Published === $project->status
            ? Response::allow()
            : Response::deny('You do not have permission to view this project.');
    }

}
