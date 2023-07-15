<?php

declare(strict_types=1);

namespace App\Client\Domain;

use App\Client\Infrastructure\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

final readonly class ClientObserver
{

    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function creating(Client $client): void
    {
        if (! App::runningInConsole()) {
            $client->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function created(Client $client): void {}


    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function deleting(Client $client): void {}


    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function deleted(Client $client): void {}


    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function updating(Client $client): void
    {
        $client->slug = Str::of($client->title)->slug('-');
    }


    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function updated(Client $client): void {}

}
