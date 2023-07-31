<?php

declare(strict_types=1);

namespace App\Core\Livewire\Application\Components\Client;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\Shared\Enums\Promoted;
use App\Core\Shared\Enums\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListing extends Component
{

    use AuthorizesRequests, WithPagination;

    public ClientEloquentModel $client;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function mount(ClientEloquentModel $client): void
    {
        $this->client = $client;
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
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function toggleStatePromoted(string $id): void
    {
        $client = $this->client->find($id);

        $state = ('not_promoted' === $client->promoted->value)
            ? Promoted::YES->value
            : Promoted::NO->value;

        $client->update([
            'promoted' => $state
        ]);
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function toggleStatePublished(string $id): void
    {
        $client = $this->client->find($id);

        if ('draft' === $client->status->value) {
            $client->update([
                'status' => Status::Published->value,
                'published_at' => Date::now()
            ]);
        } else {
            $client->update([
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
        $clients = ClientEloquentModel::where('user_id', auth()->user()->id)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->latest('created_at')
            ->withCount('projects')
            ->paginate(20);

        return view('ae.client.list', [
            'clients' => $clients
        ]);
    }

}
