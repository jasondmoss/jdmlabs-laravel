<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel(
    'Aenginus.User.Infrastructure.EloquentModels.UserEloquentModel.{id}',
    static function ($user, $id) {
        return (int) $user->id === (int) $id;
    }
);
