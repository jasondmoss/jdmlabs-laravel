<?php

declare(strict_types=1);

namespace App\Livewire\Application\Components\Client;

use App\Client\Infrastructure\ClientModel;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as ApplicationFoundation;
use Livewire\Component;
use Livewire\WithPagination;

class PublishedClients extends Component
{

    use WithPagination;

    public string $search = '';


    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    public function render(): View|ApplicationFoundation|Factory|ApplicationContract
    {
        $clients = ClientModel::where('status', '=', 1)
            ->latest('id')
            ->paginate(10);

        return view('public.client._list', [
            'clients' => $clients
        ]);
    }

}
