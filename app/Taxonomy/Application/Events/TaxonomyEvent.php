<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Events;

use App\Auth\Infrastructure\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TaxonomyEvent {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Model $model;

    public User|Authenticatable|null $user;


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        if (Auth::user()) {
            $this->user = Auth::user();
        }
    }


    /**
     * @return \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('channel-name');
    }

}
