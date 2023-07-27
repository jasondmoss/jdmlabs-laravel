<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Client;

use App\Client\Infrastructure\Client;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedClients extends Component
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
        $clients = Client::where('status', '=', 'published')
            ->latest('id')
            ->paginate(10);

        return view('public.client._list', [
            'clients' => $clients
        ]);
    }

}
