<?php

declare(strict_types=1);

namespace App\Client\Application\Repositories\Eloquent;

use App\Client\Domain\Contracts\StoreContract;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(object $data): ClientEloquentModel
    {
        return ClientEloquentModel::create([
            'name' => $data->name,
            'itemprop' => $data->itemprop,
            'website' => $data->website,
            'summary' => $data->summary,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'user_id' => $data->user_id
        ]);
    }

}
