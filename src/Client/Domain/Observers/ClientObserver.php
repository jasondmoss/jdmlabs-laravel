<?php

declare(strict_types=1);

namespace Aenginus\Client\Domain\Observers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Illuminate\Support\Facades\App;

final readonly class ClientObserver
{

    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
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
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return void
     */
    public function created(ClientEloquentModel $client): void {}


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return void
     */
    public function deleting(ClientEloquentModel $client): void {}


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return void
     */
    public function deleted(ClientEloquentModel $client): void {}


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return void
     */
    public function updating(ClientEloquentModel $client): void {}


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return void
     */
    public function updated(ClientEloquentModel $client): void {}

}
