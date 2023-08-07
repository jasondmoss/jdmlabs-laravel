<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Policies;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ClientPolicy
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

        return Response::deny('You are not authorized to create a new client.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(UserEloquentModel $user, ClientEloquentModel $client): Response
    {
        if ($user->id === $client->user_id) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this client.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserEloquentModel $user, ClientEloquentModel $client): Response
    {
        if ($user->id === $client->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this client.');
    }


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(ClientEloquentModel $client): Response
    {
        if ($client->status === Status::Published) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this client.');
    }

}
