<?php

declare(strict_types=1);

namespace App\Livewire;

use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

final class CategoryAdminListing extends Component
{

    use AuthorizesRequests, WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';


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
        $categories = CategoryEloquentModel::where('name', 'LIKE', '%' . $this->search . '%')
            ->withCount('articles')
            ->paginate(50);

        return view('aenginus.taxonomy.category.list', compact('categories'));
    }

}
