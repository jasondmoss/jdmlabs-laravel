<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Policies;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

final readonly class ClientPolicy
{

    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel|null $user
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(UserEloquentModel|null $user, ClientEloquentModel $client): Response
    {
        if ($client->status === Status::Published) {
            return Response::allow();
        }

        // Visitors cannot view unpublished items
        if ($user === null) {
            return Response::deny('You do not have permission to view this client.');
        }

        // Admin overrides published status
        if ($user->can('clients-view')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this client.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserEloquentModel $user): Response
    {
        if ($user->can('clients-create')) {
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
    public function update(UserEloquentModel $user, ClientEloquentModel $client): Response
    {
        if ($user->can('clients-update') && $user->id === $client->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this client.');
    }


    /**
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserEloquentModel $user): Response
    {
        if ($user->can('clients-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this client.');
    }

}
