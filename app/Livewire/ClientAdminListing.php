<?php

declare(strict_types=1);

namespace App\Livewire;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

final class ClientAdminListing extends Component
{

    use AuthorizesRequests, WithPagination;

    public ClientEloquentModel $client;

    public string $search = '';

    protected string $paginationTheme = 'tailwind';


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
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
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotFindClient
     */
    public function toggleStatePromoted(string $id): void
    {
        $client = $this->client->find($id);

        $state = ($client->promoted->value === 'not_promoted')
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
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotFindClient
     */
    public function toggleStatePublished(string $id): void
    {
        $client = $this->client->find($id);

        if ($client->status->value === 'draft') {
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

        return view('aenginus.client.list', compact('clients'));
    }

}
