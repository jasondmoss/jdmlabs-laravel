<?php

declare(strict_types=1);

namespace Aenginus\Livewire\Components;

use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Shared\Enums\Pinned;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

final class ProjectAdminListing extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public string $query = '';


    /**
     * @return void
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function toggleStatePinned(string $id): void
    {
        $projectModel = new ProjectModel();

        $project = $projectModel->find($id);

        $state = ($project->pinned->value === 'not_pinned') ? Pinned::IsPinned->value : Pinned::NotPinned->value;

        $project->update([
            'pinned' => $state
        ]);
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function toggleStatePromoted(string $id): void
    {
        $projectModel = new ProjectModel();

        $project = $projectModel->find($id);

        $state = ($project->promoted->value === 'not_promoted') ? Promoted::YES->value : Promoted::NO->value;

        $project->update([
            'promoted' => $state
        ]);
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function toggleStatePublished(string $id): void
    {
        $projectModel = new ProjectModel();

        $project = $projectModel->find($id);

        if ($project->status->value === 'draft') {
            $project->update([
                'status' => Status::Published->value,
                'published_at' => Date::now()
            ]);
        } else {
            $project->update([
                'status' => Status::Draft->value,
                'published_at' => null
            ]);
        }
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        $projects = ProjectModel::where('title', 'LIKE', '%' . $this->query . '%')->latest('created_at')->with(
                'clients'
            )->paginate(20);

        return view('aenginus.project.list', compact('projects'));
    }

}
