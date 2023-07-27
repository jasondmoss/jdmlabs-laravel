<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Project;

use App\Project\Infrastructure\Project;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedProjects extends Component
{

    use WithPagination;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


    public function paginationView(): string
    {
        return 'shared.pager';
    }


    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    public function render(): View
    {
        $projects = Project::where('status', '=', 'published')
            ->latest()
            ->orderBy('created_at', 'desc')
            ->with('clients')
            ->paginate(10);

        return view('public.project._list', [
            'projects' => $projects
        ]);
    }

}
