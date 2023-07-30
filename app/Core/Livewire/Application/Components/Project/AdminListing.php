<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Project;

use App\Core\Shared\Enums\Pinned;
use App\Core\Shared\Enums\Promoted;
use App\Core\Shared\Enums\Status;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListing extends Component
{

    use WithPagination;

    public ProjectEloquentModel $project;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


    /**
     * @param \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel $project
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
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     */
    public function toggleStatePinned(string $id): void
    {
        $project = $this->project->find($id);

        $state = ('not_pinned' === $project->pinned->value)
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
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     */
    public function toggleStatePromoted(string $id): void
    {
        $project = $this->project->find($id);

        $state = ('not_promoted' === $project->promoted->value)
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
     * @throws \App\Project\Application\Exceptions\CouldNotFindProject
     */
    public function toggleStatePublished(string $id): void
    {
        $project = $this->project->find($id);

        if ('draft' === $project->status->value) {
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

        return view('ae.project.list', [
            'projects' => $projects
        ]);
    }

}
