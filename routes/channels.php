<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel(

    'Aenginus.User.Domain.Models.UserModel.{id}',
    static function ($user, $id) {
        return (int) $user->id === (int) $id;
    }

);
