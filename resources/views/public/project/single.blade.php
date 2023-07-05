@php
use App\Client\Application\Controllers;
@endphp
<x-public.layout title="{{ $project->title }}" page="show" schema="ItemPage" type="page detail" livewire="true">
  <header>
    {{--@if ($project->hasMedia('signatures'))
      {{ $project->getFirstMedia('signatures') }}
    @endif--}}
    <h1>{{ $project->title }}</h1>
    <h2>{{ $project->subtitle }}</h2>
    @if ($project->website)
      <p><a rel="external" href="{{ $project->website }}" title="{{ __('Visit website') }}">{{ $project->website }}</a>
      </p>
    @endif
    {{--@if ($project->categories)
      <nav class="">
        @foreach($project->categories as $category)
          {{ $loop->first ? '' : ', ' }}
          <a itemprop="tag" href="/projects/topic/{{ $category->slug }}">{{ $category->name }}</a>
        @endforeach
      </nav>
    @endif--}}
  </header>
  <div class="">
    <p class="">{!! $project->body !!}</p>
  </div>
  <div class="">
    <p class=""><strong>Client:</strong>
      <a href="{{ action(Controllers\SingleController::class, $project->clients->slug) }}">{{ $project->clients->name }}</a>
    </p>
  </div>
</x-public.layout>
