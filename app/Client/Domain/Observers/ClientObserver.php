<?php

declare(strict_types=1);

namespace App\Client\Domain\Observers;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use Illuminate\Support\Facades\App;

final readonly class ClientObserver
{

    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function creating(ClientEloquentModel $client): void
    {
        if (! App::runningInConsole()) {
            $client->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function created(ClientEloquentModel $client): void {}


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function deleting(ClientEloquentModel $client): void {}


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function deleted(ClientEloquentModel $client): void {}


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function updating(ClientEloquentModel $client): void {}


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function updated(ClientEloquentModel $client): void {}

}
