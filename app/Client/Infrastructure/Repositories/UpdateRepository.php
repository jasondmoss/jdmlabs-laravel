<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repositories;

use App\Client\Domain\Contracts\UpdateContract;
use App\Client\Infrastructure\Client;
use App\Client\Interface\Http\UpdateRequest;

class UpdateRepository implements UpdateContract
{

    protected Client $client;


    /**
     * @param \App\Client\Infrastructure\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @inheritDoc
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function update(UpdateRequest $data): Client
    {
        $instance = $this->client->find($data->input('id'));

        $instance->update([
            'name' => $data->name,
            'itemprop' => $data->itemprop,
            'website' => $data->website,
            'summary' => $data->summary,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'user_id' => $data->user_id
        ]);

        return Client::findOrFail($instance->id);
    }

}
