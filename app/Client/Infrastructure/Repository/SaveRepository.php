<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repository;

use App\Client\Domain\Contract\SaveContract;
use App\Client\Infrastructure\Client;
use App\Client\Interface\ClientFormRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class SaveRepository implements SaveContract
{

    private Client $model;


    public function __construct()
    {
        $this->model = new Client;
    }


    /**
     * @param \App\Client\Interface\ClientFormRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function save(ClientFormRequest $data): Client
    {
        $client = isset($data->id)
            ? $this->model->find($data->id)
            : (new Client);

        try {
            $client->name = $data->name;
//            $client->slug = $data->slug;
            $client->itemprop = $data->itemprop;
            $client->website = $data->website;
            $client->summary = $data->summary;
            $client->status = $data->status;
            $client->promoted = $data->promoted;
            $client->user_id = $data->user_id;

            $client->save();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        // Return saved client.
        return Client::findOrFail($client->id);
    }

}
