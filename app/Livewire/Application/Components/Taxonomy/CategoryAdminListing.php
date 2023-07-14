<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Taxonomy;

use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryAdminListing extends Component
{

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
        $categories = Category::where('name', 'LIKE', '%' . $this->search . '%')
            ->withCount('articles')
            ->orderBy('order')
            ->paginate(50);

        return view('ae.taxonomy.category._list', [
            'categories' => $categories
        ]);
    }

}
