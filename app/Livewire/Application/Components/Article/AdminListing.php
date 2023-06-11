<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Article;

use App\Article\Infrastructure\Article;
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
        $articles = Article::where('user_id', auth()->user()->id)
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->latest('created_at')
            ->paginate(5);

        return view('ae.article._list', [
            'articles' => $articles
        ]);
    }

}
