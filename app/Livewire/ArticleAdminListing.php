<?php

declare(strict_types=1);

namespace App\Livewire;

use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

final class ArticleAdminListing extends Component
{

    use AuthorizesRequests, WithPagination;

    public ArticleEloquentModel $article;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


    /**
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function mount(ArticleEloquentModel $article): void
    {
        $this->article = $article;
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
     * @throws \Aenginus\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function toggleStatePromoted(string $id): void
    {
        $article = $this->article->find($id);

        $state = ($article->promoted->value === 'not_promoted')
            ? Promoted::YES->value
            : Promoted::NO->value;

        $article->update([
            'promoted' => $state
        ]);
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function toggleStatePublished(string $id): void
    {
        $article = $this->article->find($id);

        if ($article->status->value === 'draft') {
            $article->update([
                'status' => Status::Published->value,
                'published_at' => Date::now()
            ]);
        } else {
            $article->update([
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
        $articles = ArticleEloquentModel::where('title', 'LIKE', '%' . $this->search . '%')
            ->latest('created_at')
            ->paginate(20);

        return view('ae.article.list', compact('articles'));
    }

}
