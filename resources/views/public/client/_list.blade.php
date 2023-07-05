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
        <div class="">
          {!! $client->summary !!}
        </div>
      </article>

    @endforeach
  </div>
@else
  <div class="">
    <strong>No matches found.</strong>
  </div>
@endif
