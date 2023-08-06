<?php

declare(strict_types=1);

namespace App\Livewire;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Aenginus\Shared\Enums\Pinned;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

final class ProjectAdminListing extends Component
{

    use WithPagination;

    public ProjectEloquentModel $project;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


    /**
     * @param \Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
     *
     * @return void
     */
    public function mount(ProjectEloquentModel $project): void
    {
        $this->project = $project;
    }


    /**
     * @return string
     */
    public function paginationView(): string
    {
        return 'shared.pager';
    }


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
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotFindProject
     */
    public function toggleStatePinned(string $id): void
    {
        $project = $this->project->find($id);

        $state = ($project->pinned->value === 'not_pinned')
            ? Pinned::IsPinned->value
            : Pinned::NotPinned->value;

        $project->update([
            'pinned' => $state
        ]);
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotFindProject
     */
    public function toggleStatePromoted(string $id): void
    {
        $project = $this->project->find($id);

        $state = ($project->promoted->value === 'not_promoted')
            ? Promoted::YES->value
            : Promoted::NO->value;

        $project->update([
            'promoted' => $state
        ]);
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Project\Application\Exceptions\CouldNotFindProject
     */
    public function toggleStatePublished(string $id): void
    {
        $project = $this->project->find($id);

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
        $projects = ProjectEloquentModel::where('title', 'LIKE', '%' . $this->search . '%')
            ->latest('created_at')
            ->with('clients')
            ->paginate(20);

        return view('ae.project.list', compact('projects'));
    }

}
