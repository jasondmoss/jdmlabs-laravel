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
    public function save(object $projectEntity): ProjectEloquentModel
    {
        return ProjectEloquentModel::create([
            'title' => $projectEntity->title,
            'subtitle' => $projectEntity->subtitle,
            'website' => $projectEntity->website,
            'summary' => $projectEntity->summary,
            'body' => $projectEntity->body,
            'status' => $projectEntity->status,
            'promoted' => $projectEntity->promoted,
            'pinned' => $projectEntity->pinned,
            'client_id' => $projectEntity->client_id,
            'category_id' => $projectEntity->category_id,
            'user_id' => $projectEntity->user_id
        ]);
    }

}
