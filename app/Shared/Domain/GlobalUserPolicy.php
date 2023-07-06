<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use App\Auth\Infrastructure\User;
use App\Shared\Domain\Enums\Status;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

final readonly class GlobalUserPolicy
{

    use HandlesAuthorization;

    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param Model $model
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(User $user, Model $model): Response
    {
        return $user->id === $model->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this entry.');
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(User $user): Response
    {
        return ($user->email === Config::get('jdmlabs.admin_email'))
            ? Response::allow()
            : Response::deny('Not authorized to create a new entry.');
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function view(Model $model): bool
    {
        return Status::Published === $model->status;
    }

}
