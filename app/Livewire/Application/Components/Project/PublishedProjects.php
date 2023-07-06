<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Project;

use App\Project\Infrastructure\ProjectModel;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as ApplicationFoundation;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedProjects extends Component {

    use WithPagination;

    public string $search = '';


    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    public function render(): View|ApplicationFoundation|Factory|ApplicationContract
    {
        $projects = ProjectModel::where('status', '=', 1)
            ->latest()
            ->orderBy('created_at', 'desc')
            ->with('clients')
            ->paginate(10);

        return view('public.project._list', [
            'projects' => $projects
        ]);
    }

}
