@php
use App\Client\Application\Controllers as Client;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
@endphp
<div class="listing-wrapper">
  <nav class="listing-search">
    <label for="search"> <span class="sr-only">{{ __('Search') }}</span>
      <input wire:model="search" class="form-input--text" placeholder="Search"> </label>
  </nav>
  @if ($clients->count())
    <div class="listing">
      @foreach ($clients as $client)
        <client id="item-{{ $client->id }}" class="item">

          <figure class="item--image">
            <a href="{{ action(Client\EditController::class, $client->id) }}" title="{{ __('Edit') }}">
              <img src="{{ asset('images/placeholder/logo.png') }}" width="100" height="100" alt=""></a>
          </figure>

          <header class="item--header">
            <h3 class="title">
              <a href="{{ action(Client\EditController::class, $client->id) }}" title="{{ __('Edit') }}">{{ $client->name }}</a>
            </h3>
          </header>

          <p class="item--id"><strong class="label">{{ __('ID') }}:</strong> {{ $client->id }}</p>

          <nav class="item--taxonomy">
            @if ($client->taxonomies)
              @foreach($client->taxonomies as $category)
                {{ $loop->first ? '' : ', ' }}
                <span itemprop="tag">{{ $category->name }}</span>
              @endforeach
            @else
              <p class="w-full">&#160;</p>
            @endif
            <p class="w-full">&#160;</p>
          </nav>

          <aside class="item--meta">
            <span class="status" title="{{ __('Published') }}">{!! Status::icon($client->status) !!}</span>
            <span class="promoted" title="{{ __('Promoted') }}">{!! Promoted::icon($client->promoted) !!}</span>
          </aside>

          <aside class="item--date">
            <time class="created" datetime="{{ Date::parse($client->created_at)->format('c') }}" title="{{ Date::parse($client->created_at)->format('c') }}">
              <strong class="label">{{ __('Created') }}:</strong>
              {{ Date::parse($client->created_at)->format('Y/m/d') }}
            </time>
            <time class="updated" datetime="{{ Date::parse($client->updated_at)->format('c') }}" title="{{ Date::parse($client->updated_at)->format('c') }}">
              <strong class="label">{{ __('Updated') }}:</strong>
              {{ Date::parse($client->updated_at)->format('Y/m/d') }}
            </time>
          </aside>

          <footer class="navigation item--actions">
            <menu>
              <li>
                <a href="{{ action(Client\EditController::class, $client->id) }}" title="{{ __('Edit client') }}">
                  <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
              </li>
              <li>
                <a rel="external" href="{{ action(Client\SingleController::class, $client->slug) }}" title="{{ __('View client') }}">
                  <i class="fa-solid fa-eye" style="color: #2ec27e;"></i> {{ __('View') }}
                </a>
              </li>
              <li>
                <a href="{{ action(Client\DestroyController::class, $client->id) }}" onclick="event.preventDefault();document.getElementById('deleteForm').submit();" title="{{ __('Delete client') }}">
                  <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                </a>
                <form id="deleteForm" class="sr-only" method="POST" action="{{ action(Client\DestroyController::class, $client->id) }}">
                  @csrf
                  {{ method_field('DELETE') }}
                </form>
              </li>
            </menu>
          </footer>

        </client>
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
