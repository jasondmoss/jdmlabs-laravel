<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Policies;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ProjectPolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->email === Config::get('jdmlabs.admin_email')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new project.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(UserEloquentModel $user, ProjectEloquentModel $project): Response
    {
        if ($user->id === $project->user_id) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this project.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, ProjectEloquentModel $project): Response
    {
        if ($user->id === $project->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this project.');
    }


    /**
     * @param \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(ProjectEloquentModel $project): Response
    {
        if ($project->status === Status::Published) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this project.');
    }

}
