<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Article;

use App\Article\Infrastructure\ArticleModel;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListing extends Component {

    use AuthorizesRequests, WithPagination;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


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
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        $articles = ArticleModel::where('user_id', auth()->user()->id)
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->latest('created_at')
            ->paginate(5);

        return view('ae.article._list', [
            'articles' => $articles
        ]);
    }

}
