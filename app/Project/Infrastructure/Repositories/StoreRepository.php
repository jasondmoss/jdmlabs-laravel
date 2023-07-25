<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repositories;

use App\Project\Domain\Contracts\StoreContract;
use App\Project\Infrastructure\Project;
use App\Project\Interface\Http\CreateRequest;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(CreateRequest $data): Project
    {
        $project = Project::create([
            'title' => $data->title,
            'subtitle' => $data->subtitle,
            'website' => $data->website,
            'summary' => $data->summary,
            'body' => $data->body,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'pinned' => $data->pinned,
            'client_id' => $data->client_id,
            /*'category_id' => $data->category,*/
            'user_id' => $data->user_id
        ]);

        return Project::findOrFail($project->id);
    }

}
