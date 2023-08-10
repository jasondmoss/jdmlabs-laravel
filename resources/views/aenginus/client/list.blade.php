@php
  use Aenginus\Client\Interface\Web\Controllers as Client;
  use Aenginus\Shared\Enums\Promoted;
  use Aenginus\Shared\Enums\Status;
  use Illuminate\Support\Facades\Date;
@endphp

<!-- list.blade -->
<div class="listing-wrapper flex flex-col gap-y-10">

  <header id="listingHeader" class="listing-header flex align-middle justify-between sticky mt-2">
    <h1 class="text-4xl">{{ __('Clients') }}</h1>

    <nav class="listing-tools flex items-center gap-x-10">
      <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ action(Client\CreateController::class) }}">Create New Client</a>

      <form wire:submit="search" wire:model="query" class="list-search">
        <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
          <input wire:model.live="search" class="form-input--text" placeholder="Search"> </label>
      </form>
    </nav>
  </header>

  @if ($clients->count())
    <div class="listing client flex flex-col">
      @foreach ($clients as $client)
        <article id="item-{{ $client->id }}" class="item grid md:grid-cols-10 gap-x-5 gap-y-3 odd:bg-white even:bg-slate-100 hover:bg-amber-50 px-2 py-10">

          <figure class="item--image md:row-start-1 md:col-start-1 md:col-span-2 md:row-span-3">
            <a href="{{ action(Client\EditController::class, $client->id) }}" title="{{ __('Edit') }}">
              @if ($client->hasMedia('logo'))
                <img src="{{ $client->getFirstMediaUrl('logo', 'preview') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/logo.png') }}" alt="">
              @endif
            </a>
          </figure>

          <header class="item--header md:row-start-1 md:row-span-2 md:col-start-3 md:col-span-6">
            <h3 class="title text-2xl">
              <a class="text-blue-500" href="{{ action(Client\EditController::class, $client->id) }}" title="{{ __('Edit') }}">{{ $client->name }}</a>
            </h3>
          </header>

          <p class="item--id md:row-start-2 md:col-start-3 md:col-span-4 self-end"><strong class="label">{{ __('ID') }}:</strong> {{ $client->id }}</p>
          <p class="item--count md:row-start-3 md:col-start-7 md:col-span-2 self-end py-1 flex align-bottom gap-2" style="color: #007741;" class="project"><strong class="label">{{ __('Projects') }}:</strong> {{ $client->projects_count }}</p>

          <aside class="item--meta md:row-start-1 md:col-start-9 md:col-span-2 flex justify-end gap-4">
            <span class="status" wire:click="toggleStatePublished('{{ $client->id }}')" title="@if ($client->status->value === 'published') {{ __('Unpublish this client') }} @else {{ __('Publish this client') }} @endif">
              {!! Status::icon($client->status) !!}
            </span>
            <span class="promoted" wire:click="toggleStatePromoted('{{ $client->id }}')" title="@if ($client->promoted->value === 'promoted') {{ __('Unpromote this client') }} @else {{ __('Promote this client') }} @endif">
              {!! Promoted::icon($client->promoted) !!}
            </span>
          </aside>

          <aside class="item--date md:row-start-2 md:row-span-2 md:col-start-9 md:col-span-2 flex flex-col gap-y-3 justify-end py-2">
            <time class="created" datetime="{{ Date::parse($client->created_at)->format('c') }}" title="{{ Date::parse($client->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($client->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated" datetime="{{ Date::parse($client->updated_at)->format('c') }}" title="{{ Date::parse($client->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($client->updated_at)->format('Y/m/d') }}
            </time>
            @if ($client->published_at !== null)
              <time class="published justify-self-end" datetime="{{ Date::parse($client->published_at)->format('c') }}" title="{{ Date::parse($client->published_at)->format('c') }}">
                <strong class="label">{{ __('Published') }}:</strong>
                {{ Date::parse($client->published_at)->format('Y/m/d') }}
              </time>
            @else
              <span class="published justify-self-end">{{ __('Not Published') }}</span>
            @endif
          </aside>

          <footer class="navigation item--actions md:row-start-3 md:col-start-3 md:col-span-3 self-end py-2">
            <menu class="flex gap-4">
              <li>
                <i class="fa-solid fa-pen-to-square"></i>
                <a class="text-blue-500" href="{{ action(Client\EditController::class, $client->id) }}" title="{{ __('Edit client') }}">{{ __('Edit') }}</a>
              </li>
              <li>
                <i class="fa-solid fa-eye" style="color: #2ec27e;"></i>
                <a rel="external" class="text-blue-500" href="{{ action(Client\SingleController::class, $client->slug) }}" title="{{ __('View client') }}">{{ __('View') }}</a>
              </li>
              <li>
                <i class="fa-solid fa-trash"></i>
                <a class="text-blue-500" href="{{ action(Client\DestroyController::class, $client->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete client') }}">{{ __('Delete') }}</a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Client\DestroyController::class, $client->id) }}">
                  @csrf
                  {{ method_field('DELETE') }}
                </form>
              </li>
            </menu>
          </footer>
        </article>

      @endforeach
    </div>

    {{-- Pagination. --}}
    {{ $clients->links() }}
  @else
    <div class="w-full mt-8 p-20">
      <strong>No clients found.</strong>
    </div>
  @endif
</div>
