<?php

declare(strict_types=1);

namespace Aenginus\Livewire\Components;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

final class CategoryAdminListing extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public string $query = '';


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
        $categories = CategoryModel::where('name', 'LIKE', '%' . $this->query . '%')
            ->withCount('articles', 'projects')
            ->orderBy('name')
            ->paginate(50);

        return view('aenginus.taxonomy.category.list', compact('categories'));
    }

}
