<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Auth.Domain.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
