<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Taxonomy;

use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Contracts\View\View;
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


    public function render(): View
    {
        $vocabularies = Vocabulary::where('name', 'LIKE', '%' . $this->search . '%')
            ->latest('name')
            ->paginate(50);

        return view('ae.taxonomy.vocabulary._list', [
            'vocabularies' => $vocabularies
        ]);
    }

}
