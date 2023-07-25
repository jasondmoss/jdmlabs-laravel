<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repositories;

use App\Project\Domain\Contracts\UpdateContract;
use App\Project\Infrastructure\Project;
use App\Project\Interface\Http\UpdateRequest;

final class UpdateRepository implements UpdateContract
{

    protected Project $project;


    /**
     * @param \App\Project\Infrastructure\Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @inheritDoc
     */
    public function update(UpdateRequest $data): Project
    {
        $instance = $this->project->find($data->input('id'));

        $instance->update([
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

        return Project::findOrFail($instance->id);
    }

}
