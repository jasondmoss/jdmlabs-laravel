@php
@endphp

<x-public.layout title="Projects" page="index" schema="CollectionPage" type="page listing project" livewire="true">
  <header class="">
    <h1>{{ __('Projects') }}</h1>
  </header>

  <div class="listings">
    @if ($projects->count())
      @foreach ($projects as $project)
        <article itemscope itemtype="https://schema.org/Article" itemid="{{ $project->permalink }}" id="{{ $project->id }}" class="h-entry h-as-article card">
          <figure class="item--image">
            <a href="{{ $project->permalink }}" title="{{ __('View project') }}">
              @if ($project->hasMedia('signature'))
                <img src="{{ $project->getFirstMediaUrl('signature', 'preview') }}" alt="">
              @else
                <img class="placeholder" src="{{ asset('images/placeholder/signature.png') }}" alt="">
              @endif
            </a>
          </figure>
          <header>
            <h3 class="">
              <a href="{{ $project->permalink }}">{{ $project->title }}</a>
            </h3>
            @if (! is_null($project->category))
              <nav class="navigation taxonomy">
                <i class="fa-solid fa-tag" style="color:#f00"></i>
                <a itemprop="tag" class="label-category" href="#" title="{{ __('') }}">{{ $project->category->name }}</a>
              </nav>
            @endif
          </header>
          <div class="entry-summary">
            {!! $project->summary !!}
          </div>
          <footer>
            @if (@auth()->check())
              <a rel="nofollow" class="button" href="{{ action(\Aenginus\Project\Interface\Web\Controllers\EditController::class, $project->id) }}">{{ __('Edit') }}</a>
            @endif
          </footer>
        </article>

        {{--@if ($loop->first)
          {{ dump($project) }}
        @endif--}}
      @endforeach
    @else
      <div class="">
        <strong>No matches found.</strong>
      </div>
    @endif
  </div>
</x-public.layout>
