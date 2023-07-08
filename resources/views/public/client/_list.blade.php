@php
use App\Client\Application\Controllers as Client;
@endphp
@if ($clients->count())
  <div class="listings client">
    @foreach ($clients as $client)
      <article class="">
        <header>
          <h3 class="">
            <a href="{{ action(Client\SingleController::class, $client->slug) }}">{{ $client->name }}</a>
          </h3>
        </header>
        <div class="entry-summary">
          {!! $client->summary !!}
        </div>
        <footer>
          @if (@auth()->check())
            <a rel="nofollow" class="button" href="{{ action(Client\EditController::class, $client->id) }}">{{ __('Edit') }}</a>
          @endif
        </footer>
      </article>

    @endforeach
  </div>
@else
  <div class="">
    <strong>No matches found.</strong>
  </div>
@endif
