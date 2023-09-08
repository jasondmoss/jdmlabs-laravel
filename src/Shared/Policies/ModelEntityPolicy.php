<?php

declare(strict_types=1);

namespace Aenginus\Shared\Policies;

use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model as EntityModel;
use Illuminate\Support\Facades\Config;

final readonly class ModelEntityPolicy
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

        return Response::deny('You are not authorized to create a new entity.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(UserEloquentModel $user, EntityModel $model): Response
    {
        if ($user->id === $model->user_id) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this entity.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, EntityModel $model): Response
    {
        if ($user->id === $model->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this entity.');
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(EntityModel $model): Response
    {
        if ($model->status === Status::Published) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this entity.');
    }

}
