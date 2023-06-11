<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Project;

use App\Project\Infrastructure\Project;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as ApplicationFoundation;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListing extends Component {

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


    public function render(): View|ApplicationFoundation|Factory|ApplicationContract
    {
        $projects = Project::where('title', 'LIKE', '%' . $this->search . '%')
            ->latest('created_at')
            ->with('clients')
            ->paginate(5);

        return view('ae.project._list', [
            'projects' => $projects
        ]);
    }

}
