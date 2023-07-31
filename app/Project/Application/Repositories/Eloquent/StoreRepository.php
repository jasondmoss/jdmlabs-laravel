<?php

declare(strict_types=1);

namespace App\Project\Application\Repositories\Eloquent;

use App\Project\Domain\Contracts\StoreContract;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(object $data): ProjectEloquentModel
    {
        return ProjectEloquentModel::create([
            'title' => $data->title,
            'subtitle' => $data->subtitle,
            'website' => $data->website,
            'summary' => $data->summary,
            'body' => $data->body,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'pinned' => $data->pinned,
            'client_id' => $data->client_id,
            'category_id' => $data->category_id,
            'user_id' => $data->user_id
        ]);
    }

}
