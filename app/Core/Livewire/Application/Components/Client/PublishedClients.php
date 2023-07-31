<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Client;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedClients extends Component
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
        $clients = ClientEloquentModel::where('status', '=', 'published')
            ->latest('id')
            ->paginate(10);

        return view('public.client._list', [
            'clients' => $clients
        ]);
    }

}
