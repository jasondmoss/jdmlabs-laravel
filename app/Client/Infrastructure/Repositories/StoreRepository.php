<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repositories;

use App\Client\Domain\Contracts\StoreContract;
use App\Client\Infrastructure\Client;
use App\Client\Interface\Http\CreateRequest;

class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(CreateRequest $data): Client
    {
        $client = Client::create([
            'name' => $data->name,
            'itemprop' => $data->itemprop,
            'website' => $data->website,
            'summary' => $data->summary,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'user_id' => $data->user_id
        ]);

        // Return saved client.
        return Client::findOrFail($client->id);
    }

}
