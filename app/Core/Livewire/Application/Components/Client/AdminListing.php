<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Client;

use App\Client\Infrastructure\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListing extends Component
{

    use AuthorizesRequests, WithPagination;

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
        $clients = Client::where('user_id', auth()->user()->id)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->latest('created_at')
            ->paginate(20);

        return view('ae.client.list', [
            'clients' => $clients
        ]);
    }

}
