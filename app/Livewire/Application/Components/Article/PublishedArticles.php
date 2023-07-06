<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Article;

use App\Article\Infrastructure\ArticleModel;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedArticles extends Component
{

    use WithPagination;

    public string $search = '';


    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    public function render()
    {
        $articles = ArticleModel::where('status', '=', 1)
            ->latest()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.article._list', [
            'articles' => $articles
        ]);
    }

}
