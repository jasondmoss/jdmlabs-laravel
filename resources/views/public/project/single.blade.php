<?php
  use Aenginus\Client\Interface\Web\Controllers as Client;
?>
<x-public.layout
  schema="ItemPage"
  title="{{ $project->title }}"
  page="project"
  context="detail"
  livewire="true"
>
  <x-shared.session/>
  {!! $project->getSignatureImage(); !!}

  <header>
    <h1>{{ $project->title }}</h1>
    <h2>{{ $project->subtitle }}</h2>

    @if ($project->website)
      <p><a rel="external" href="{{ $project->website }}" title="{{ __('Visit website') }}">{{ $project->website }}</a></p>
    @endif

    @if ($project->category !==  null)
      <p class="">
        <span>{{ __('Filed under') }}:</span>
        <a itemprop="tag" href="/projects/category/{{ $project->category->slug }}">{{ $project->category->name }}</a>
      </p>
    @endif
  </header>

  <div>
    <p>{!! $project->body !!}</p>
  </div>

  <div>
    <p><strong>Client:</strong>
      <a href="{{ action(Client\SingleController::class, $project->clients->slug) }}">{{ $project->clients->name }}</a>
    </p>
  </div>
</x-public.layout>
