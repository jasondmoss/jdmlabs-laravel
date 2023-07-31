<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Article;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedArticles extends Component
{

    use WithPagination;

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
        $articles = ArticleEloquentModel::published('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.article._list', [
            'articles' => $articles
        ]);
    }

}
