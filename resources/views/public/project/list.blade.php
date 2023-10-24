<?php
  use Aenginus\Project\Interface\Web\Controllers as Project;
?>
<x-public.layout
  schema="CollectionPage"
  title="Projects"
  page="project"
  context="listing"
  livewire="true"
>
  <x-shared.session/>
  <header>
    <h1>{{ __('Projects') }}</h1>
  </header>

  <div>
    @if ($projects->count())
      @foreach ($projects as $project)
        <article itemscope itemtype="https://schema.org/Article" itemid="{{ $project->permalink }}" id="{{ $project->id }}" class="h-entry h-as-article">
          @if($project->signature !== null)
            <figure>
              <a href="{{ $project->permalink }}" title="{{ __('View project') }}">
                <x-shared.media.thumbnail :model="$project" :image="$project->signature" />
              </a>
            </figure>
          @endif

          <header>
            <h3>
              <a href="{{ $project->permalink }}">{{ $project->title }}</a>
            </h3>

            @if ($project->category !== null)
              <nav>
                <i class="fa-solid fa-tag" style="color:#f00"></i>
                <a itemprop="tag" class="label-category" href="#" title="{{ __('') }}">{{ $project->category->name }}</a>
              </nav>
            @endif
          </header>

          <div>
            {!! $project->summary !!}
          </div>

          <footer>
            @if (@auth()->check())
              <a rel="nofollow" href="{{ action(Project\EditController::class, $project->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                </svg>
                <span class="srt">{{ __('Edit') }}</span>
              </a>
            @endif
          </footer>
        </article>

        {{--@if ($loop->first)
          {{ dump($project) }}
        @endif--}}
      @endforeach
    @else
      <div>
        <strong>No matches found.</strong>
      </div>
    @endif
  </div>
</x-public.layout>
