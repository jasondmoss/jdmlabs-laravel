<?php

declare(strict_types=1);

namespace App\Client\Domain;

use App\Auth\Infrastructure\User;
use App\Client\Infrastructure\Client;
use App\Shared\Domain\Enums\Status;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

final readonly class ClientPolicy
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
            : Response::deny('You are not authorized to create a new client.');
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function owner(User $user, Client $client): Response
    {
        return $user->id === $client->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this client.');
    }


    /**
     * @param \App\Auth\Infrastructure\User $user
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Client $client): Response
    {
        return $user->id === $client->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to edit this client.');
    }


    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(Client $client): Response
    {
        return Status::Published === $client->status
            ? Response::allow()
            : Response::deny('You do not have permission to view this client.');
    }

}
