@php
  use App\Client\Application\Controllers;
@endphp
<x-public.layout title="{{ $project->title }}" page="show" schema="ItemPage" type="page detail" livewire="true">
  <header>
    {{ $signature }}
    <h1>{{ $project->title }}</h1>
    <h2>{{ $project->subtitle }}</h2>
    @if ($project->website)
      <p><a rel="external" href="{{ $project->website }}" title="{{ __('Visit website') }}">{{ $project->website }}</a>
      </p>
    @endif
    @if (! is_null($project->category))
      <p class="">
        <span>{{ __('Filed under') }}:</span>
        <a itemprop="tag" href="/projects/category/{{ $project->category->slug }}">{{ $project->category->name }}</a>
      </p>
    @endif
  </header>
  <div class="">
    <p class="">{!! $project->body !!}</p>
  </div>
  <div class="">
    <p class=""><strong>Client:</strong>
      <a href="{{ action(\App\Client\Interface\Http\Controllers\SingleController::class, $project->clients->slug) }}">{{ $project->clients->name }}</a>
    </p>
  </div>
</x-public.layout>
