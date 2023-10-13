<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Policies;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Shared\Enums\Status;
use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

final readonly class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * @param \Aenginus\User\Domain\Models\UserModel|null $user
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(?UserModel $user, ClientModel $client): Response
    {
        if ($client->status === Status::Published) {
            return Response::allow();
        }

        // Visitors cannot view unpublished items
        if ($user === null) {
            return Response::deny('You do not have permission to view this client.');
        }

        // Admin overrides published status
        if ($user->can('clients-read')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this client.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(UserModel $user): Response
    {
        if ($user->can('clients-create')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a new client.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(UserModel $user, ClientModel $client): Response
    {
        if ($user->can('clients-update') && $user->id === $client->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this client.');
    }


    /**
     * @param \Aenginus\User\Domain\Models\UserModel $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(UserModel $user): Response
    {
        if ($user->can('clients-delete')) {
            return Response::allow();
        }

        return Response::deny('You are not the owner of this client.');
    }
}
