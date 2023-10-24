<?php
  use Aenginus\Project\Interface\Web\Controllers as Project;
?>
<x-public.layout
  schema="ItemPage"
  title="{{ $client->title }}"
  page="client"
  context="detail"
  livewire="true"
>
  <x-shared.session/>
  {!! $client->getSignatureImage(); !!}

  <header>
    <h1>{{ $client->name }}</h1>
    <p><a rel="external" href="{{ $client->website }}">{{ $client->website }}</a></p>
  </header>

  <div>
    <p>{!! $client->summary !!}</p>
  </div>

  <div>
    <h2>{{ __('Projects')  }}</h2>

    @if ($client->projects)
      @foreach ($client->projects as $project)
        <p>
          <a href="{{ action(Project\SingleController::class, [ $client->slug, $project->slug ]) }}">{{ $project->title }}</a>
        </p>
      @endforeach
    @endif
  </div>
</x-public.layout>
