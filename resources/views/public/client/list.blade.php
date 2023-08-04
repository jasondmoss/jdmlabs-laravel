@php
  use  App\Client\Interface\Web\Controllers as Client;
@endphp

<x-public.layout title="Clients" page="index" schema="WebPage" type="page listing" livewire="true">
  <header>
    <h1 class="">{{ __('Clients') }}</h1>
  </header>

  <div class="listings client">
    @if ($clients->count())
      @foreach ($clients as $client)
        <article class="h-entry h-as-article card">
          <figure class="item--image">
            <a href="{{ $client->permalink }}" title="{{ __('View client') }}">
              @if ($client->hasMedia('logos'))
                <img src="{{ $client->getFirstMediaUrl('logos', 'preview') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/logo.png') }}" alt="">
              @endif
            </a>
          </figure>
          <header>
            <h3 class="">
              <a href="{{ $client->permalink }}">{{ $client->name }}</a>
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

        {{--@if ($loop->first)
          {{ dump($client) }}
        @endif--}}
      @endforeach
    @else
      <div class="">
        <strong>No matches found.</strong>
      </div>
    @endif
  </div>
</x-public.layout>
