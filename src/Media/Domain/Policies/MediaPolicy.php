<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Policies;

use Aenginus\Media\Infrastructure\EloquentModels\MediaEloquentModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

final readonly class MediaPolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel|null $user
     * @param \Aenginus\Media\Infrastructure\EloquentModels\MediaEloquentModel $media
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(UserEloquentModel|null $user, MediaEloquentModel $media): Response
    {
        if ($media->status === Status::Published) {
            return Response::allow();
        }

        // Visitors cannot view unpublished items
        if ($user === null) {
            return Response::deny('You do not have permission to view this media.');
        }

        // Admin overrides published status
        if ($user->can('media-publish')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this media.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->can('media-create')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new media.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Media\Infrastructure\EloquentModels\MediaEloquentModel $media
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, MediaEloquentModel $media): Response
    {
        if ($user->can('media-edit')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this media.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserEloquentModel $user): Response
    {
        if ($user->can('media-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this media.');
    }

}
