<?php

declare(strict_types=1);

namespace Aenginus\Livewire\Components;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

final class ClientAdminListing extends Component
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
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function toggleStatePromoted(string $id): void
    {
        $clientModel = new ClientModel();

        $client = $clientModel->find($id);

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
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function toggleStatePublished(string $id): void
    {
        $clientModel = new ClientModel();

        $client = $clientModel->find($id);

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
        $clients = ClientModel::where('user_id', auth()->user()->id)
            ->where('name', 'LIKE', '%' . $this->query . '%')
            ->latest('created_at')
            ->withCount('projects')
            ->paginate(20);

        return view('aenginus.client.list', compact('clients'));
    }
}
