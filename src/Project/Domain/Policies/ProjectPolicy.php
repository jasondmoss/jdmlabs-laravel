<?php

declare(strict_types=1);

namespace Aenginus\Project\Domain\Policies;

use Aenginus\Project\Domain\Model\ProjectModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

final readonly class ProjectPolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel|null $user
     * @param \Aenginus\Project\Domain\Model\ProjectModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(UserEloquentModel|null $user, ProjectModel $project): Response
    {
        if ($project->status === Status::Published) {
            return Response::allow();
        }

        // Visitors cannot view unpublished items
        if ($user === null) {
            return Response::deny('You do not have permission to view this project.');
        }

        // Admin overrides published status
        if ($user->can('projects-view')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this project.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->can('projects-create')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new project.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Project\Domain\Model\ProjectModel $project
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, ProjectModel $project): Response
    {
        if ($user->can('projects-update') && $user->id === $project->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this project.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserEloquentModel $user): Response
    {
        if ($user->can('projects-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this project.');
    }

}
