<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Repository;

use App\Project\Domain\Contract\SaveContract;
use App\Project\Infrastructure\Project;
use App\Project\Interface\ProjectFormRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SaveRepository implements SaveContract
{

    private Project $model;


    public function __construct()
    {
        $this->model = new Project;
    }


    /**
     * @param \App\Project\Interface\ProjectFormRequest $data
     *
     * @return \App\Project\Infrastructure\Project
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function save(ProjectFormRequest $data): Project
    {
        $project = isset($data->id)
            ? $this->model->find($data->id)
            : (new Project);

        try {
            $project->title = $data->title;
//            $project->slug = Str::slug($data->title);
            $project->subtitle = $data->subtitle;
            $project->website = $data->website;
            $project->client_id = $data->client_id;
            $project->summary = $data->summary;
            $project->body = $data->body;
            $project->status = $data->status;
            $project->promoted = $data->promoted;
            $project->pinned = $data->pinned;

            $project->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        // Return saved project.
        return Project::findOrFail($project->id);
    }

}
