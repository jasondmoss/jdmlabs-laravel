<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Article;

use App\Article\Infrastructure\Article;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedArticles extends Component
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
        $articles = Article::published('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.article._list', [
            'articles' => $articles
        ]);
    }

}
